<?php

namespace App\View\Components;

use Illuminate\View\Component;

class File extends Component
{
    public $name;
    public $value;
    public $placeholder;

    public function __construct($name, $value = null, $placeholder = null)
    {
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('components.file');
    }
}
