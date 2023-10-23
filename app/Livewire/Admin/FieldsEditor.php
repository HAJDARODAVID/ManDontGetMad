<?php

namespace App\Livewire\Admin;

use App\Models\AdminFigureModel;
use App\Models\FieldsModel;
use Livewire\Component;

class FieldsEditor extends Component
{
    public $selectedField;
    public $moveIncre = 1;
    public $newFieldName;
    public $fields;
    public $fieldProperty;

    public function mount(){
        $this->fields = FieldsModel::all();
    }


    public function updatedSelectedField(){
        $field=FieldsModel::where('alias', $this->selectedField)->first();
        if($field != NULL){
            AdminFigureModel::where('id',1)->update([
                'top' =>$field->top,
                'left' =>$field->left,
            ]);
            $this->fieldProperty = $field;
        }
    }

    public function moveUp(){
        $adminFigure=AdminFigureModel::where('id',1)->first();
        $adminFigure->update(['top' => $adminFigure->top - $this->moveIncre]);
    }

    public function moveDown(){
        $adminFigure=AdminFigureModel::where('id',1)->first();
        $adminFigure->update(['top' => $adminFigure->top + $this->moveIncre]);
    }

    public function moveLeft(){
        $adminFigure=AdminFigureModel::where('id',1)->first();
        $adminFigure->update(['left' => $adminFigure->left - $this->moveIncre]);
    }

    public function moveRight(){
        $adminFigure=AdminFigureModel::where('id',1)->first();
        $adminFigure->update(['left' => $adminFigure->left + $this->moveIncre]);
    }

    public function createNewField(){
        $this->selectedField = $this->newFieldName;
        $this->newFieldName = "";
    }

    public function saveField(){
        $field=FieldsModel::where('alias', $this->selectedField)->first();
        $adminFigure= AdminFigureModel::where('id',1)->first();
        if($field != NULL){            
            $field->update([
                'top' =>$adminFigure->top,
                'left' =>$adminFigure->left,
            ]);
            $this->selectedField= $this->selectedField;
            return redirect(route('fieldsEditor'));
        }else{
            FieldsModel::create([
                'alias' => $this->selectedField,
                'top' =>$adminFigure->top,
                'left' =>$adminFigure->left,
            ]);
            $this->selectedField= $this->selectedField;
            return redirect(route('fieldsEditor'));
        }

    }

    public function render()
    {
        return view('livewire.admin.fields-editor');
    }
}
