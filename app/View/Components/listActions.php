<?php

namespace App\View\Components;

use Illuminate\View\Component;

class listActions extends Component
{
    public $actions;
    public $id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($actions, $id = '')
    {
        $this->actions = $actions;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.list-actions');
    }
}
