<?php

namespace App\Livewire\Admin;

use App\Models\GameRoom;
use App\Models\GameRoomMember;
use Livewire\Component;
use Livewire\Attributes\On; 

class JoinGameButton extends Component
{
    public $user;
    public $selectedUser;
    public $display = 'none';
    public $rooms = []; 

    public function showModal($user){
        $this->rooms = GameRoom::where('status', 0)->orderBy('id', 'DESC')->get();
        $this->dispatch('stop-user-refresh');
        $this->selectedUser = $user;
        $this->display = 'block'; 
    }

    public function joinRoom($roomSelected){
            GameRoomMember::create([
            'user_id' => $this->user,
            'game_id' => $roomSelected,
            'isMyTurn' => 0, 
        ]);
        $this->display = 'none';
        $this->dispatch('start-user-refresh');
    }

    public function render()
    {
        return view('livewire.admin.join-game-button',[
            'selectedUser' => $this->selectedUser,]);
    }
}
