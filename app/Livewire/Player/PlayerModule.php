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
    public $diceValue = 6;

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

    public function moveFigure($subFigure){

        dd($this->getPositionStatus($this->getStartPosition()->id));
        dd($this->getPositionStatus($this->getStartPosition()->id));

        if ($this->getPositionStatus($this->getStartPosition()->id) != NULL) {
            $whoIsOnTheField = $this->getPositionStatus($this->getStartPosition()->id)->figure_id;
        }else{
            $whoIsOnTheField = 0;
        }

        dd($whoIsOnTheField);
       
        //move player to start position
        if($this->diceValue == 6 && $this->getIsFigureHome($subFigure) && $whoIsOnTheField != $this->playerInfo->figure_id){
          $this->getFigure($subFigure)->update([
            'field_id' => $this->getStartPosition()->id,
          ]);
        }

        
        
    }


    public function render()
    {
        return view('livewire.player.player-module');
    }
}
