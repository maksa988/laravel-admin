<?php

namespace Maksa988\LaravelAdmin\Http\Controllers;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return $this->view(true);
    }
}