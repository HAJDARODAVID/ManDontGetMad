<?php

namespace App\Livewire\Admin;

use App\Models\GameRoomMember;
use Livewire\Component;

class KickOutButton extends Component
{
    public $user;
    
    public function kickPlayerOutOfRoom(){
        GameRoomMember::where('user_id', $this->user)->delete();
    }
    public function render()
    {
        return view('livewire.admin.kick-out-button');
    }
}
