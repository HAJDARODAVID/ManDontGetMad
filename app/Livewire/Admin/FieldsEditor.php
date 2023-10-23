<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class FieldsEditor extends Component
{
    public $selectedField = 4;
    public $moveIncre;
    public $newFieldName;

    public function createNewField(){
        $this->selectedField = $this->newFieldName;
        $this->newFieldName = "";
    }

    public function render()
    {
        return view('livewire.admin.fields-editor');
    }
}
