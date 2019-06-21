<?php

namespace Maksa988\LaravelAdmin\Http\Controllers;

use \Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

abstract class Controller extends BaseController
{
    /**
     * Get the evaluated view contents for the given view from route name.
     *
     * @param bool|array $package
     * @param  \Illuminate\Contracts\Support\Arrayable|array $data
     * @param  array $mergeData
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    protected function view($package = false, $data = [], $mergeData = [])
    {
        $view = request()->route()->getName();

        if(is_array($package)) {

            $mergeData = $data;

            $data = $package;

            $package = false;
        }

        if($package === true) {
            $view = Str::replaceFirst('admin.', 'admin::', $view);
        }

        return view($view, $data, $mergeData);
    }
}