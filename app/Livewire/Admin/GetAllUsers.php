<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class GetAllUsers extends Component
{
    public function render()
    {
        return view('livewire.admin.get-all-users',[
            'players' => User::where('type', 1)->with('getPlayerRoom.getGameInfo')->get(),
        ]);
    }
}
