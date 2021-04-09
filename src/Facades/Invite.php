<?php

namespace Distortion\LaravelInvite\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Distortion\LaravelInvite\Skeleton\SkeletonClass
 */
class Invite extends Facade
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
