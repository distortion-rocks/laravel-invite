<?php

namespace Distortion\LaravelInvite\Tests\Unit;

use Distortion\LaravelInvite\Enums\InviteStatus;
use Distortion\LaravelInvite\Models\InviteModel;
use Distortion\LaravelInvite\Tests\TestCase;

class InviteModelTest extends TestCase
{
    /** @test */
    public function can_tell_invite_is_successful()
    {
        $invite = new InviteModel(['status' => InviteStatus::successful()->value]);

        $this->assertTrue($invite->isSuccessful());
    }

    /** @test */
    public function can_tell_invite_is_pending()
    {
        $invite = new InviteModel(['status' => InviteStatus::pending()->value]);

        $this->assertTrue($invite->isPending());
    }

    /** @test */
    public function can_tell_invite_is_cancelled()
    {
        $invite = new InviteModel(['status' => InviteStatus::canceled()->value]);

        $this->assertTrue($invite->isCanceled());
    }

    /** @test */
    public function can_tell_invite_is_expired()
    {
        $invite = new InviteModel(['status' => InviteStatus::expired()->value]);

        $this->assertTrue($invite->isExpired());
    }
}
