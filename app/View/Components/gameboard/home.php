<?php

namespace App\View\Components\gameboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class home extends Component
{
    public $top;
    public $left;
    public $color;
    public $rotation;
    /**
     * Create a new component instance.
     */
    public function __construct($top, $left, $color, $rotation)
    {
        $this->top=$top;
        $this->left=$left;
        $this->color = $color;
        $this->rotation = $rotation;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gameboard.home');
    }
}
