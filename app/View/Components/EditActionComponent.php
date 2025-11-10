<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class EditActionComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $route;
    public $objectData;
    public $method;
    public $title;
    public $modalSize;
    
    
    public function __construct($route,$objectData,$method,$title,$modalSize )
    {
        $this->route = $route;
        $this->objectData = $objectData;
        $this->method = $method;
        $this->title = $title;
        $this->modalSize = $modalSize;
     
      
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.edit-action-component');
    }
}
