<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class EditModalComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $objectData;
    public $route;
    public $title;
    public $modalSize;
    public function __construct($objectData, $route, $title, $modalSize)
    {
        $this->objectData = $objectData;
        $this->route = $route;
        $this->title = $title;
        $this->modalSize = $modalSize;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.edit-modal-component');
    }
}
