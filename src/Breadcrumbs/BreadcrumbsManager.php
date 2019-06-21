<?php

namespace Maksa988\LaravelAdmin\Breadcrumbs;

use DaveJamesMiller\Breadcrumbs\BreadcrumbsManager as Base;

class BreadcrumbsManager extends Base
{
    /**
     * @param $name
     * @param $title
     *
     * @throws \DaveJamesMiller\Breadcrumbs\Exceptions\DuplicateBreadcrumbException
     * @throws \DaveJamesMiller\Breadcrumbs\Exceptions\UnnamedRouteException
     */
    public function resource($name, $title)
    {
        $routeName = $this->getCurrentRoute()[0];

        $this->for($name . '.index', function ($trail) use ($name, $title, $routeName) {
            $trail->parent(config('admin.breadcrumbs.parent.name'));
            $trail->push(__($title), route($routeName));
        });

        $this->for($name . '.create', function ($trail) use ($name, $title, $routeName) {
            $trail->parent($name . '.index');
            $trail->push(__("Create"), route($routeName));
        });

        $this->for($name . '.edit', function ($trail) use ($name, $title, $routeName) {
            $trail->parent($name . '.index');
            $trail->push(__("Edit"), route($routeName));
        });

        $this->for($name . '.show', function ($trail) use ($name, $title, $routeName) {
            $trail->parent($name . '.index');
            $trail->push(__("Create"), route($routeName));
        });
    }
}