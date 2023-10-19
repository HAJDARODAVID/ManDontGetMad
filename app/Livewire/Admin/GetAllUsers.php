<?php

namespace App\Livewire\Admin;
use Livewire\Attributes\On;

use App\Models\User;
use Livewire\Component;

class GetAllUsers extends Component
{
    public $refresh = 1;

    #[On('stop-user-refresh')]
    public function stopRefresh(){
        $this->refresh = 0;
    }

    #[On('start-user-refresh')]
    public function startRefresh(){
        $this->refresh = 1;
    }

    public function render()
    {
        return view('livewire.admin.get-all-users',[
            'players' => User::where('type', 1)->with('getPlayerRoom.getGameInfo')->get(),
        ]);
    }
}
