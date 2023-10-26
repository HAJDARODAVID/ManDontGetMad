<?php

namespace App\Livewire\Player;

use App\Models\FieldsModel;
use App\Models\FiguresPositionModel;
use Livewire\Component;
use App\Models\GameRoomMember;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class PlayerModule extends Component
{
    public $playerInfo;
    public $playerFigures;
    public $diceThrows;
    public $diceValue = 1;

    public function mount(){
        $this->playerInfo = GameRoomMember::where('user_id', Auth::user()->id)->first();
        $this->playerFigures = FiguresPositionModel::where('game_id', $this->playerInfo->game_id)
        ->where('figure_id',  $this->playerInfo->figure_id)
        ->get();
        $this->getDiceThrows();
    }
    public function throwDice(){
        $this->diceValue = rand(1,6);
        if($this->diceValue == 6){
            $this->diceThrows++;
        }
        $this->diceThrows--;     
    }

    private function getDiceThrows(){
        $playerFields = FiguresPositionModel::where('game_id', $this->playerInfo->game_id)
        ->where('figure_id',  $this->playerInfo->figure_id)
        ->with('getFieldInfo')->get();

        $isPlayerHome = 0;
        foreach ($playerFields as $fields) {
            if(str_contains($fields->getFieldInfo->alias,'home')){
                $isPlayerHome++;
            }
        }

        if($isPlayerHome ==4){
            return $this->diceThrows = 3;
        }

        return $this->diceThrows = 1;
    }

    private function getFigure($subFigure){
        return FiguresPositionModel::where('game_id', $this->playerInfo->game_id)
        ->where('figure_id',$this->playerInfo->figure_id)
        ->where('figure_sub_id', $subFigure)
        ->with('getFieldInfo');
    }

    private function getStartPosition(){
        return FieldsModel::where('alias', 'like', 'start_' . $this->playerInfo->getFigureInfo->alias)->first();
    }

    private function getHomePosition($figure){
        return FieldsModel::where('alias', 'like', '%_home_' . $figure)->first();
    }

    private function getPositionStatus($field){
        return FiguresPositionModel::where('game_id', $this->playerInfo->game_id)
        ->where('field_id', $field)->first();
    }

    private function getIsFigureHome($subFigure){
        $figure = FiguresPositionModel::where('game_id', $this->playerInfo->game_id)
        ->where('figure_id',$this->playerInfo->figure_id)
        ->where('figure_sub_id', $subFigure)
        ->with('getFieldInfo')->first();

        return str_contains($figure->getFieldInfo->alias,'home');
    }

    private function getNewFieldPosition($fieldId){
        $field = FieldsModel::where('id', $fieldId)->first();
        $nextField = $field->nextField;
        for ($i=1; $i <= $this->diceValue; $i++) {
            if($nextField==NULL){
                return;
            }
            if(FieldsModel::where('id', $nextField)->first()->alias == 'start_'.$this->playerInfo->getFigureInfo->alias){
                $nextField = FieldsModel::where('alias',  $this->playerInfo->getFigureInfo->alias.'_finish1')->first()->id;
            } 
            $field = FieldsModel::where('id', $nextField)->first();
            $nextField = $field->nextField;            
        }  
        return $field;
    }

    public function moveFigure($subFigure){

        //Get the start field status
        if ($this->getPositionStatus($this->getStartPosition()->id) != NULL) {
            $whoIsOnTheField = $this->getPositionStatus($this->getStartPosition()->id);
            $whoIsOnTheFieldId = $whoIsOnTheField->figure_id;
        }else{
            $whoIsOnTheFieldId = 0;
        }

        //Move player to start position
        if($this->diceValue == 6 && $this->getIsFigureHome($subFigure) && $whoIsOnTheFieldId != $this->playerInfo->figure_id){
          $this->getFigure($subFigure)->update([
            'field_id' => $this->getStartPosition()->id,
          ]);
          //If enemy is on my field eat him 
          if($whoIsOnTheFieldId){
            $home= $this->getHomePosition($whoIsOnTheField->figure_id . $whoIsOnTheField->figure_sub_id);
            $whoIsOnTheField->update([
                'field_id' => $home->id,
            ]);
            $this->diceValue =0;
          }
          return;
        }

        //Move player the dice value amount
        if(!($this->getIsFigureHome($subFigure))){
            $moveTo=$this->getNewFieldPosition($this->getFigure($subFigure)->first()->field_id);
            if($moveTo == NULL){
                return;
            }
            $whoIsOnTheField = $this->getPositionStatus($moveTo->id);
            $whoIsOnTheFieldId = $whoIsOnTheField == NULL ? 0 : $whoIsOnTheField->figure_id;

            if($whoIsOnTheFieldId == $this->playerInfo->figure_id){
                return;
            }elseif ($whoIsOnTheFieldId) {
                $home= $this->getHomePosition($whoIsOnTheField->figure_id . $whoIsOnTheField->figure_sub_id);
                $whoIsOnTheField->update([
                    'field_id' => $home->id,
                ]);
                $this->getFigure($subFigure)->update([
                    'field_id' => $moveTo->id,
                ]);
            }else{
                $this->getFigure($subFigure)->update([
                    'field_id' => $moveTo->id,
                ]);
            }
        }
    }


    public function render()
    {
        return view('livewire.player.player-module');
    }
}
