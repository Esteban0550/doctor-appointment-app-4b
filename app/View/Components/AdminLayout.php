<?php

namespace App\View\Components;

use Closure;
<<<<<<< HEAD
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
=======
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423

class AdminLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.admin');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423
