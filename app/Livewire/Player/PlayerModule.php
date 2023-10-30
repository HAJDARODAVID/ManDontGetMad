<?php

namespace App\Livewire\Player;

use App\Http\Controllers\GameController;
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
    public $diceValue;
    public $dice=[
        '1'=>'#9856;',
        '2'=>'#9857;',
        '3'=>'#9858;',
        '4'=>'#9859;',
        '5'=>'#9860;',
        '6'=>'#9861;',
    ];
    public $diceIcon;
    public $displayBtn;

    public $throwsHas = 0;
    public $throwsLeft;

    public function mount(){
        $this->playerInfo = GameRoomMember::where('user_id', Auth::user()->id)->first();
        //dd($this->playerInfo);
        if($this->playerInfo != NULL){
            $this->playerFigures = FiguresPositionModel::where('game_id', $this->playerInfo->game_id)
            ->where('figure_id',  $this->playerInfo->figure_id)->with('getFigureSymbol')->get();
            $this->displayBtn = 1;

        }
        
    }

    public function booted(){
        $this->throwsLeft = $this->getPlayerMovements() - $this->throwsHas;
    }

    public function throwDice(){
        //get dice value, and icon
        $this->diceValue = rand(1,6);
        $this->diceIcon = $this->dice[$this->diceValue];

        $this->throwsHas++;
        $this->throwsLeft = $this->getPlayerMovements() - $this->throwsHas;

        if($this->getPlayerMovements() == 3 &&  $this->throwsLeft == 0 && $this->diceValue!=6){
            $this->gameLogic();
        }

        if($this->throwsLeft == 0){
            $this->displayBtn = 0; 
        }

        $figures = $this->playerFigures;
        $canMove=false;
        foreach ($figures as $figure) {
            if($this->canFiguresMove($figure->figure_sub_id)){
                $canMove=true;
            }   
        }

        if (!$canMove && $this->throwsLeft == 0){
            $this->gameLogic();
        }
    }

    private function getPlayerMovements(){

        if($this->playerInfo != NULL){
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
                return 3;
            }

            return 1;
        }
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

    public function gameLogic()
    {
        if($this->diceValue == 6){
            $this->displayBtn = 1;
            $this->diceValue = 0;
            return redirect(route('home'));
        }   

        $this->diceValue = 0;

        if( $this->throwsLeft == 0){
            GameController::endMyTurn($this->playerInfo->game_id, $this->playerInfo->user_id);
            if(!(GameController::checkIfNextRound($this->playerInfo->game_id))){
                GameController::startNewRound($this->playerInfo->game_id);
            }
            GameController::getNextPlayerTurn($this->playerInfo->game_id);
            return redirect(route('home'));           
        }
    }

    private function canFiguresMove($subFigure){

        //Get the start position status
        if ($this->getPositionStatus($this->getStartPosition()->id) != NULL) {
            $whoIsOnTheField = $this->getPositionStatus($this->getStartPosition()->id);
            $whoIsOnTheFieldId = $whoIsOnTheField->figure_id;
        }else{
            $whoIsOnTheFieldId = 0;
        }
        //Get if figure can move to start position
        if($this->diceValue == 6 && $this->getIsFigureHome($subFigure) && $whoIsOnTheFieldId != $this->playerInfo->figure_id){
            return true;
        }
        
        if(!($this->getIsFigureHome($subFigure))){
            $moveTo=$this->getNewFieldPosition($this->getFigure($subFigure)->first()->field_id);
            if($moveTo == NULL){
                return false;
            }
            $whoIsOnTheField = $this->getPositionStatus($moveTo->id);
            $whoIsOnTheFieldId = $whoIsOnTheField == NULL ? 0 : $whoIsOnTheField->figure_id;

            if($whoIsOnTheFieldId == $this->playerInfo->figure_id){
                return false;
            }else{
                return true;
            }
        }
        return false;

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
            }
            $this->gameLogic();
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
                $this->gameLogic();
            }else{
                $this->getFigure($subFigure)->update([
                    'field_id' => $moveTo->id,
                ]);
                $this->gameLogic();
            }
        }
    }


    public function render()
    {
        return view('livewire.player.player-module');
    }
}
