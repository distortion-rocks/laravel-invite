<?php

namespace Distortion\LaravelInvite\Tests\Unit;

use Carbon\Carbon;
use Distortion\LaravelInvite\Enums\InviteStatus;
use Distortion\LaravelInvite\Facades\Invite;
use Distortion\LaravelInvite\Models\InviteModel;
use Distortion\LaravelInvite\Tests\TestCase;

class ValidateInviteTest extends TestCase
{

    /** @test */
    public function can_verify_invite_is_valid()
    {
        $invite = InviteModel::factory()->create();

        $this->assertTrue(Invite::isValid($invite->code));
    }

    /** @test */
    public function can_verify_invite_is_not_valid_even_if_status_is_pending()
    {
        $invite = InviteModel::factory()->create(['expires' => '2021-04-10 13:00:00']);

        $this->assertFalse(Invite::isValid($invite->code));
    }

    /** @test */
    public function can_update_invite_status_to_expired_if_expired()
    {
        $invite = InviteModel::factory()->create(['expires' => '2021-04-10 13:00:00']);

        $this->assertFalse(Invite::isValid($invite->code));

        $updatedInvite = InviteModel::find($invite->id);

        $this->assertEquals(InviteStatus::expired()->value, $updatedInvite->status);
    }
}
