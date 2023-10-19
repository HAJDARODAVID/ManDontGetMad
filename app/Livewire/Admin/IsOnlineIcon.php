<?php

namespace App\Livewire\Admin;

use App\Http\Controllers\PlayerController;
use Livewire\Component;

class IsOnlineIcon extends Component
{   
    public $player;
    
    public function render()
    {
        return view('livewire.admin.is-online-icon',[
            'isOnline' => PlayerController::getUserOnlineStatus($this->player)
        ]);
    }
}
