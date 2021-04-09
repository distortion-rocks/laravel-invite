<?php

namespace Distortion\LaravelInvite\Contracts;

interface InviteManagerContract
{
    /**
     * Create a new invite.
     */
    public function invite(string $email, int $referrer_id, ?string $expiration_date = null): string;

    /**
     * Set the invite code being used.
     */
    public function setCode(string $code): InviteManagerContract;

    /**
     * Get invite instance by code.
     */
    public function get();
}
