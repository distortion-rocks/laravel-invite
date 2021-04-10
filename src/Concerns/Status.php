<?php

namespace Distortion\LaravelInvite\Concerns;

use Distortion\LaravelInvite\Enums\InviteStatus;

trait Status
{
    /**
     * Checks invitation is successful.
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->status === InviteStatus::successful()->value;
    }

    /**
     * Checks invitation is pending.
     *
     * @return bool
     */
    public function isPending()
    {
        return $this->status === InviteStatus::pending()->value;
    }

    /**
     * Checks invitation is canceled.
     *
     * @return bool
     */
    public function isCanceled()
    {
        return $this->status === InviteStatus::canceled()->value;
    }

    /**
     * Checks invitation is canceled.
     *
     * @return bool
     */
    public function isExpired()
    {

        if ($this->status == InviteStatus::expired()->value) {
            return true;
        }

        if (strtotime($this->expires) >= time()) {
            return false;
        }

        $this->status = InviteStatus::expired()->value;
        $this->save();

        return true;
    }
}
