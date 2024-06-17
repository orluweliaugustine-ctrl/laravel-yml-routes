<?php

namespace Broswilli\LaravelYmlRoutes;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Broswilli\LaravelYmlRoutes\Skeleton\SkeletonClass
 */
class LaravelYmlRoutesFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-yml-routes';
    }
}
