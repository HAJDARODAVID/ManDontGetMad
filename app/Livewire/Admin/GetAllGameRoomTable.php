<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\GameRoom;
use Livewire\Attributes\On; 
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PlayerController;
use App\Models\GameRoomMember;

class GetAllGameRoomTable extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function test($room){
        $roomObj= GameRoom::where('id', $room)->first();
        $roomMemberObj = GameRoomMember::where('game_id', $roomObj->id)->get();
        foreach ($roomMemberObj as $member) {
            PlayerController::removeUserFromGame($member->getPlayerInfo);
        }
        $roomObj->update([
            'status' => -1,
        ]);
    }

    #[On('refreshComponent')]
    public function render()
    {
        return view('livewire.admin.get-all-game-room-table',[
            'gameRooms' => AdminController::getAllGameRooms(),
        ]);
    }
}
