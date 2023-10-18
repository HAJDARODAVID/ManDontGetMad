<?php

namespace App\Livewire\Gameboard;

use Livewire\Component;
use App\Models\GameRoomMember;

class PlayersFigures extends Component
{
    public $gameId;
    public $players;
    

    public function mount(){
        $this->players = GameRoomMember::where('game_id', $this->gameId)->with(['getPlayerInfo'])->get();
    }
    
    public function render()
    {
        return view('livewire.gameboard.players-figures');
    }
}
