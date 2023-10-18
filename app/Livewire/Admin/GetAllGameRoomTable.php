<?php

namespace App\Livewire\Admin;

use App\Http\Controllers\AdminController;
use Livewire\Component;
use Livewire\Attributes\On; 

class GetAllGameRoomTable extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    #[On('refreshComponent')]
    public function render()
    {
        return view('livewire.admin.get-all-game-room-table',[
            'gameRooms' => AdminController::getAllGameRooms(),
        ]);
    }
}
