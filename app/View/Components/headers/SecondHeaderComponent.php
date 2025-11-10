<?php

namespace App\View\Components\headers;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class SecondHeaderComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $createRoute;
    public $invitationRoute;
    public $searchRoute;
    public function __construct( $createRoute,  $invitationRoute=null,  $searchRoute = null)
    {
        $this->createRoute = $createRoute;
        $this->invitationRoute = $invitationRoute;
        $this->searchRoute = $searchRoute;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.headers.second-header-component');
    }
}
