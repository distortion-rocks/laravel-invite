<?php

namespace Distortion\LaravelInvite;

trait Invitable {

    public function invites() {
        return $this->hasMany(config('laravelinvite.invite-model'));
    }

}