<?php

namespace Distortion\LaravelInvite\Contracts;

interface InviteContract
{
    public function invite(string $email, int $referrer_id, ?string $expiration_date = null);
}
