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

    /**
     * Setup migrations
     */
    public function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/../database/migrations/create_invites_table.php.stub';

        // Run migrations
        (new \CreateInvitesTable())->up();
    }
}
