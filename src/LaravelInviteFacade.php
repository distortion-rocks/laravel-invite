<?php

namespace Distortion\LaravelInvite;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Distortion\LaravelInvite\Skeleton\SkeletonClass
 */
class LaravelInviteFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'invite';
    }
}
