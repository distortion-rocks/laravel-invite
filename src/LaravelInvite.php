<?php

namespace Distortion\LaravelInvite;

use Carbon\Carbon;
use Distortion\LaravelInvite\Contracts\InviteContract;
use Distortion\LaravelInvite\Contracts\InviteManagerContract;
use RuntimeException;

class LaravelInvite implements InviteContract
{
    public $manager;

    public function __construct(InviteManagerContract $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Create invitation.
     * @param string $email
     * @param int $referer
     * @param null $expires
     *
     * @return string
     */
    public function invite($email, $referer, $expires = null): string
    {
        $expires = $expires === null ? Carbon::now()->addHours(config('laravelinvite.expiration')) : $expires;
        $this->isValidEmail($email);

        return $this->manager->invite($email, $referer, $expires);
    }

    /**
     * Get invite instance.
     */
    public function get($code)
    {
        return $this->manager->setCode($code)->get();
    }

    /**
     * Check email address is valid.
     * @param string email
     * @return self
     */
    private function isValidEmail($email)
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new RuntimeException("Invalid email: {$email}", 1);
        }

        return $this;
    }
}
