<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectListV3 extends Component
{
    public $options;

    public function __construct($options)
    {
        $this->options = $options;
    }

    public function render()
    {
        return view('components.select-list-v3');
    }

}
