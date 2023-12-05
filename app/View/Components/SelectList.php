<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectList extends Component
{
    public $options;

    public function __construct($options)
    {
        $this->options = $options;
    }

    public function render()
    {
        return view('components.select-list');
    }
}
