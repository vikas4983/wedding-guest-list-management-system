<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class SwitchButtonComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $route;
    public $method;
    public $objectData;
    public function __construct($route,$method,$objectData)
    {
        $this->route=$route;
        $this->method=$method;
        $this->objectData=$objectData;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.switch-button-component');
    }
}
