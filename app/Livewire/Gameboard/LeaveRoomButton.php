<?php

namespace App\Livewire\Gameboard;

use Illuminate\Http\Request;
use Livewire\Component;

class LeaveRoomButton extends Component
{
    public function leaveRoom(Request $request){
        $request->session()->pull('gameRoom');
        return redirect(route('gameboard'));
    }

    public function render()
    {
        return view('livewire.gameboard.leave-room-button');
    }
}
