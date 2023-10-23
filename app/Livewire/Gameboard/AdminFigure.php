<?php

namespace App\Livewire\Gameboard;

use App\Models\AdminFigureModel;
use Livewire\Component;

class AdminFigure extends Component
{
    public $position;

    public function mount(){
        $this->position = AdminFigureModel::where('id',1)->first();
    }
    
    public function render()
    {
        return view('livewire.gameboard.admin-figure');
    }
}
