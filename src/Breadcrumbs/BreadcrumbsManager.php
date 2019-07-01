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
        $this->for($name . '.index', function ($trail) use ($name, $title) {
            $trail->parent(config('admin.breadcrumbs.parent.name'));
            $trail->push(__($title), route($name . '.index'));
        });

        $this->for($name . '.create', function ($trail) use ($name, $title) {
            $trail->parent($name . '.index');
            $trail->push(__("*.Create"), route($name . '.create'));
        });

        $this->for($name . '.edit', function ($trail, $data) use ($name, $title) {
            $trail->parent($name . '.index');
            $trail->push(__("*.Edit"), route($name . '.edit', $data));
        });

        $this->for($name . '.show', function ($trail, $data) use ($name, $title) {
            $trail->parent($name . '.index');
            $trail->push($data->title ?? __("*.Show"), route($name . '.show', $data));
        });
    }
}