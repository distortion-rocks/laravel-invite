<?php

namespace Distortion\LaravelInvite\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Distortion\LaravelInvite\LaravelInviteServiceProvider;

class TestCase extends Orchestra
{

    protected function getPackageProviders($app)
    {
        return [LaravelInviteServiceProvider::class];
    }
}
