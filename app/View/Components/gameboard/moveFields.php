<?php

namespace App\View\Components\gameboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class moveFields extends Component
{   
    public $top;
    public $left;
    public $rotation;
    public $baseColor;
    public $id;
    
    /**
     * Create a new component instance.
     */
    public function __construct($top, $left, $rotation, $baseColor, $id="moveFields")
    {
        $this->top = $top;
        $this->left = $left;
        $this->rotation = $rotation;
        $this->baseColor = $baseColor;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gameboard.move-fields');
    }
}
