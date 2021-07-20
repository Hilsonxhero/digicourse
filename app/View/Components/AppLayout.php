<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Get the views / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('Front::layout.app');
    }
}
