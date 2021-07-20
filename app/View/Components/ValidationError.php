<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ValidationError extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.validation-error');
    }
}
