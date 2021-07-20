<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextArea extends Component
{
    public $name;
    public $placeholder;
    public $value;

    public function __construct($name, $placeholder, $value = null)
    {
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.text-area');
    }
}
