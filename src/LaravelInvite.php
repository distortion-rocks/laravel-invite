<?php

namespace Distortion\LaravelInvite;

use Carbon\Carbon;
use Distortion\LaravelInvite\Contracts\InviteContract;
use Distortion\LaravelInvite\Enums\InviteStatus;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LaravelInvite implements InviteContract
{

    /**
     * Email address for invite.
     * @var string
     */
    private $email;

    /**
     * Referral code for invite.
     * @var string
     */
    private $code = null;

    /**
     * If code exists in DB or not.
     * @var bool
     */
    private $exists;

    /**
     * ID of referer
     * @var int
     */
    private $referer;

    /**
     * Date of referral code expiration.
     * @var DateTime
     */
    private $expires;

    /**
     * Invite model instance.
     * @var Distortion\LaravelInvite\Models\InviteModel
     */
    private $model = null;

    /**
     * Creates a new invite
     * 
     * @param string $email
     * @param int $referer_id
     * @param string $expiration
     * 
     * @return string
     */
    public function invite(string $email, int $referer_id, ?string $expiration_date = null)
    {
        $this->setupInviteInputs($email, $referer_id, $expiration_date)->createNewInvite();

        return $this->code;
    }

    /**
     * Get the default status for an invite.
     * 
     * @return string
     */
    public function getDefaultStatus()
    {
        return InviteStatus::pending()->value;
    }

    /**
     * Get the default expiration.
     * 
     * @return DateTime
     */
    public function getDefaultExpiration()
    {
        return (Carbon::now())->addHours(config('laravelinvite.expire'))->toDateTimeString();
    }

    /**
     * Generate unique referrer code and save the invite.
     * 
     * @return self
     */
    private function createNewInvite()
    {
        $code = md5(uniqid('', true));

        return $this->save($code);
    }

    /**
     * Save the new invite and dispatch event.
     * 
     * @return self
     */
    private function save($code)
    {
        $this->getModelInstance();

        // Set params
        $this->model->email = $this->email;
        $this->model->user_id = $this->referer;
        $this->model->expires = $this->expires;
        $this->model->code = $code;
        $this->model->status = $this->getDefaultStatus();

        if($this->model->save())
        {
            $this->code = $code;
            $this->exists = true;
            return $this;
        }
    }

    /**
     * Create a new model instance of an invite.
     * @return self
     */
    private function getModelInstance($new = true)
    {
        $model = config('laravelinvite.invite-model');

        if($new) {
            $this->model = new $model;
            return $this;
        }

        try {
            $this->model = (new $model)->where('code', $this->code)->firstOrFail();
            $this->exists = true;

            return $this;
        } catch (ModelNotFoundException $e) {
            throw new Exception("Invalid Token {$this->code}", 400);
        }
    }

    /**
     * Set the params for the invitation.
     * 
     * @return self
     */
    private function setupInviteInputs($email, $referer_id, $expiration) {
        $this->email = $email;
        $this->referer = $referer_id;

        if(is_null($expiration)) {
           $this->expires = $this->getDefaultExpiration();
        } else {
            $this->expires = $expiration;
        }

        return $this;
    }

}
