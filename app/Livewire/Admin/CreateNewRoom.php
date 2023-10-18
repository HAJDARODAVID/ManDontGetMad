<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\GameRoom;
use App\Livewire\Admin\GetAllGameRoomTable;

class CreateNewRoom extends Component
{
    public function createNewRoom(){
        GameRoom::create(['status'=>0]);
        $this->dispatch('refreshComponent');
    }
    public function render()
    {
        return view('livewire.admin.create-new-room');
    }
}
