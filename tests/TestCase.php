<?php

namespace Distortion\LaravelInvite\Tests;

use Distortion\LaravelInvite\LaravelInviteServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [LaravelInviteServiceProvider::class];
    }
}
