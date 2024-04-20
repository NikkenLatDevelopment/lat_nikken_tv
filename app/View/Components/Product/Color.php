<?php

namespace App\View\Components\Product;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Color extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public array $colors, public int $available)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product.color');
    }
}
