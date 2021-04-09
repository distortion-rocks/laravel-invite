<?php

namespace Distortion\LaravelInvite\Tests\Fixtures;

use Distortion\LaravelInvite\Invitable;
use Illuminate\Database\Eloquent\Model;

class User extends Model {
    use Invitable;

    protected $guarded = [];
}