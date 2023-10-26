<?php

namespace App\Livewire\Gameboard;

use App\Models\FiguresPositionModel;
use Livewire\Component;
use App\Models\GameRoomMember;

class PlayersFigures extends Component
{
    public $gameId;
    public $players;
    

    public function mount(){
        $this->players = FiguresPositionModel::where('game_id',$this->gameId)->with('getFigureInfo','getFieldInfo','getFigureSymbol')->get();
    }
    
    public function render()
    {
        return view('livewire.gameboard.players-figures');
    }
}
