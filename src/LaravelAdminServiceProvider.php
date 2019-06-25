<?php

namespace Maksa988\LaravelAdmin;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Maksa988\LaravelAdmin\Console\ControllerMakeCommand;
use Maksa988\LaravelAdmin\Console\RequestMakeCommand;

class LaravelAdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }

        $this->registerResources();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            RequestMakeCommand::class,
            ControllerMakeCommand::class,
        ]);
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../config/admin.php' => config_path('admin.php'),
        ], 'admin-config');

        $this->publishes([
            __DIR__.'/../resources/js' => resource_path('js/admin'),
            __DIR__.'/../resources/sass' => resource_path('sass'),
        ], 'admin-assets');

//        $this->publishes([
//            __DIR__.'/../resources/views' => resource_path('views/vendor/admin'),
//        ], 'admin-views');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'admin-migrations');
    }

    /**
     * Register the package resources such as routes, templates, etc.
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'admin');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->registerRoutes();
        $this->registerBreadcrumbs();
        $this->registerBladeDirectives();
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        /*
         * Register main routes
         */
        Route::group($this->routeMainConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
        });

        /*
         * Register custom routes
         */
        Route::group($this->routeCustomConfiguration(), function () {
            if(File::exists(config('admin.routes.file', base_path('routes/admin.php')))) {
                $this->loadRoutesFrom(config('admin.routes.file', base_path('routes/admin.php')));
            }
        });
    }

    /**
     * Get the Nova route group configuration array.
     *
     * @return array
     */
    protected function routeMainConfiguration()
    {
        return [
            'namespace' => 'Maksa988\LaravelAdmin\Http\Controllers',
            'domain' => config('admin.domain', null),
            'as' => 'admin.',
            'prefix' => LaravelAdmin::path(),
            'middleware' => config('admin.routes.middleware', 'admin'),
        ];
    }

    /**
     * Get the Nova route group configuration array.
     *
     * @return array
     */
    protected function routeCustomConfiguration()
    {
        return [
            'namespace' => config('admin.routes.namespace', 'App\Http\Controllers\Admin'),
            'domain' => config('admin.domain', null),
            'as' => 'admin.',
            'prefix' => LaravelAdmin::path(),
            'middleware' => config('admin.routes.middleware', 'admin'),
        ];
    }

    /**
     * Register the package breadcrumbs.
     *
     * @return void
     */
    protected function registerBreadcrumbs()
    {
        config()->set('breadcrumbs.files', array_merge(
            (array) config('breadcrumbs.files'),
            [__DIR__.'/../routes/breadcrumbs.php']
        ));

        config()->set('breadcrumbs.manager-class', \Maksa988\LaravelAdmin\Breadcrumbs\BreadcrumbsManager::class);
    }

    /**
     * Register the package blade directives.
     *
     * @return void
     */
    protected function registerBladeDirectives()
    {
        Blade::directive('breadcrumbs', function ($expression) {
            return "<?php echo Breadcrumbs::render($expression); ?>";
        });

        Blade::component('admin::components._form-group', 'formGroup');
    }
}