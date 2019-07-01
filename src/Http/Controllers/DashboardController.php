<?php

namespace Maksa988\LaravelAdmin\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return $this->view(true);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearCache()
    {
        Artisan::call('cache:clear');

        return redirect(route('admin.dashboard'))->with('message', __('Cache clear'));
    }
}