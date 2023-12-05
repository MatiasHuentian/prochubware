<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectWithPivot extends Component
{
    public $options , $changefunction;

    public function __construct($options , $changefunction)
    {
        $this->options = $options;
        $this->changefunction = $changefunction;
    }

    public function render()
    {
        return view('components.select-with-pivot');
    }
}
