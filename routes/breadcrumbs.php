<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

/*
 * BreadCrumbs
 */

/*
 * Parent Home Breadcrumb
 */
if(! Breadcrumbs::exists(config('admin.breadcrumbs.parent.name', 'admin.dashboard'))) {
    Breadcrumbs::for(config('admin.breadcrumbs.parent.name', 'admin.dashboard'), function ($trail) {
        $trail->push(__(config('admin.breadcrumbs.parent.title', '*.Home')), route(config('admin.breadcrumbs.parent.name', 'admin.dashboard')));
    });
}
