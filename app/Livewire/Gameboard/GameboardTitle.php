<?php

namespace App\Livewire\Gameboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class GameboardTitle extends Component
{
    public $counter = 0;
    public $lastName;

    public function delete(){
        $this->counter++; 
    }
    public function render()
    {
        return view('livewire.gameboard.gameboard-title', [
            'counter' => $this->counter,
            'ln' => $this->lastName
        ]);
    }
}
