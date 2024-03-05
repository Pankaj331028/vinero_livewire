<?php

namespace App\View\Components;

use Illuminate\View\Component;

class breadcrumb extends Component
{
    public $title;
    public $module;
    public $link;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $module = '', $link = '')
    {
        $this->title  = $title;
        $this->module = $module;
        $this->link   = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}
