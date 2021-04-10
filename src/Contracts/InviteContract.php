<?php

namespace Distortion\LaravelInvite\Contracts;

interface InviteContract
{
    public function invite($email, $referer, $expires = null): string;

    public function get($code);
}
