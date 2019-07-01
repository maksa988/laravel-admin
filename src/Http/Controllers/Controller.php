<?php

namespace Maksa988\LaravelAdmin\Http\Controllers;

use \Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Maksa988\LaravelFilters\Filters;

abstract class Controller extends BaseController
{
    protected $modelName;

    /**
     * Get the evaluated view contents for the given view from route name.
     *
     * @param bool|array $package
     * @param  \Illuminate\Contracts\Support\Arrayable|array $data
     * @param  array $mergeData
     *
     * @return \Illuminate\View\View|\Illuminate\Http\Response
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

    /**
     * Execute an action on the controller.
     *
     * @param  string  $method
     * @param  array   $parameters
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        if(! method_exists($this, $method)) {
            return $this->view(compact($parameters));
        }

        return parent::callAction($method, $parameters);
    }
}