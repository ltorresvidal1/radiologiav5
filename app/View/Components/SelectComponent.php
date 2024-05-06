<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $options;

    public function __construct($options)
    {
        $this->options = $options;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-component');
    }
}
