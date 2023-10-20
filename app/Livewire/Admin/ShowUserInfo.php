<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class ShowUserInfo extends Component
{
    public $user;
    public $display = 'none';
    public $userInfo;

    public function showModal(){
        $this->userInfo = User::where('id', $this->user)->with('getLastRequest', 'getPlayerRoom.getGameInfo')->first();
        $this->dispatch('stop-user-refresh');
        $this->display = 'block'; 
    }

    public function render()
    {
        return view('livewire.admin.show-user-info');
    }
}
