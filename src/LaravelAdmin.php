<?php

namespace Maksa988\LaravelAdmin;

class LaravelAdmin
{
    /**
     * Version of package
     *
     * @var string
     */
    const VERSION = '0.1';

    /**
     * Get the current Nova version.
     *
     * @return string
     */
    public static function version()
    {
        return self::VERSION;
    }

    /**
     * Get the app name.
     *
     * @return string
     */
    public static function name()
    {
        return config('admin.name', 'Laravel Admin');
    }

    /**
     * Get the URI path prefix for admin panel.
     *
     * @return string
     */
    public static function path()
    {
        return config('admin.path', '/admin');
    }
}