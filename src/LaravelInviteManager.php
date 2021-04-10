<?php

namespace Distortion\LaravelInvite;

use Distortion\LaravelInvite\Contracts\InviteManagerContract;
use Distortion\LaravelInvite\Enums\InviteStatus;
use Distortion\LaravelInvite\Exceptions\InvalidTokenException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LaravelInviteManager implements InviteManagerContract
{
    /**
     * Instance of invite model.
     */
    public $model;

    /**
     * Invitation code.
     */
    public $code;

    /**
     * Params for invite.
     */
    public $email;

    public $referer;

    public $expires;

    /**
     * Create a new invitation.
     *
     */
    public function invite(string $email, int $referrer_id, ?string $expiration_date = null): string
    {
        $this->readInputs($email, $referrer_id, $expiration_date)->save($this->generateInviteToken());

        return $this->code;
    }

    public function get()
    {
        return $this->getModelInstance();
    }

    /**
     * Reutrns the default status for a new invite.
     * @return string
     */
    private function getDefaultStatus(): string
    {
        return InviteStatus::pending()->value;
    }

    /**
     * Save a new invite model.
     *
     * @param string $code
     * @return self
     */
    private function save($code)
    {
        $this->getModelInstance(true);

        $this->model->email = $this->email;
        $this->model->user_id = $this->referer;
        $this->model->code = $code;
        $this->model->expires = $this->expires;
        $this->model->status = $this->getDefaultStatus();

        if ($this->model->save()) {
            $this->code = $code;

            return $this;
        }
    }

    /**
     * Set the invite code.
     *
     * @param string $code
     * @return self
     */
    public function setCode(string $code): LaravelInviteManager
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Generate a new ivnite token key.
     *
     * @return string
     */
    private function generateInviteToken(): string
    {
        return md5(uniqid('', true));
    }

    /**
     * Set parameters for invite.
     * @param string $email
     * @param int $referer
     * @param string $expiration
     */
    private function readInputs($email, $referer, $expiration): LaravelInviteManager
    {
        $this->email = $email;
        $this->referer = $referer;
        $this->expires = $expiration;

        return $this;
    }

    /**
     * Get the new instance of the invite model.
     *
     * @param bool $newInstance
     * @return Model
     * @throws InvalidTokenException
     */
    private function getModelInstance(bool $newInstance = false)
    {
        $model = config('laravelinvite.invite-model');

        if ($newInstance) {
            $this->model = new $model();
            return $this;
        }

        try {
            $this->model = (new $model())->where('code', $this->code)->firstOrFail();
            return $this;
        } catch (ModelNotFoundException $e) {
            throw new InvalidTokenException("Invalid token: {$this->code}", 401);
        }
    }
}
