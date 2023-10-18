<?php

namespace App\Livewire\Gameboard;

use Livewire\Component;
use App\Models\GameRoom;
use Illuminate\Http\Request;

class SelectGameRoomModal extends Component
{
    public $display;

    public function joinRoom(Request $request, $room){
        $request->session()->put('gameRoom', $room);
        return redirect(route('gameboard'));
    }

    public function render()
    {
        return view('livewire.gameboard.select-game-room-modal', [
            'availableRooms' => GameRoom::where('status', 1)->get(),
        ]);
    }
}
