<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class DeleteActionComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $route;
    
    public function __construct($route, )
    {
        $this->route = $route;
      
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-action-component');
    }
}
