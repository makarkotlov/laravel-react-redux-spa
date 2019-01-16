<?php

namespace App\Http\ViewComposers;
use App\Department;
use Illuminate\View\View;

class RegisterComposer
{
    

    

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {   
        $departments = Department::all();
        $view->with(compact('departments'));
    }
}