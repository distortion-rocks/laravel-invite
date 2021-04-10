<?php

namespace Distortion\LaravelInvite\Tests\Unit;

use Distortion\LaravelInvite\Enums\InviteStatus;
use Distortion\LaravelInvite\Facades\Invite;
use Distortion\LaravelInvite\Tests\Fixtures\User;
use Distortion\LaravelInvite\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use RuntimeException;

class InviteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_new_invite()
    {
        $user = new User();
        $user->id = 1;

        $code = Invite::invite('test@example.com', $user->id);

        $this->assertDatabaseHas('invites', [
            'email' => 'test@example.com',
            'user_id' => 1,
            'status' => InviteStatus::pending()->value,
            'code' => $code,
        ]);
    }

    /** @test */
    public function can_create_new_invite_with_custom_expiration()
    {
        $user = new User();
        $user->id = 1;

        $code = Invite::invite('test@example.com', $user->id, '2021-04-11 12:22:11');

        $this->assertDatabaseHas('invites', [
            'email' => 'test@example.com',
            'user_id' => 1,
            'status' => InviteStatus::pending()->value,
            'expires' => '2021-04-11 12:22:11',
            'code' => $code,
        ]);
    }

    /** @test */
    public function can_not_create_new_invite_with_invalid_email()
    {
        $this->expectException(RuntimeException::class);

        Invite::invite('test@example', 1);
    }

    /** @test */
    public function can_get_instance_of_invite_with_code()
    {
        $code = Invite::invite('test@example123.net', 1);

        $result = Invite::get($code);

        $this->assertEquals('test@example123.net', $result->email);
        $this->assertEquals($code, $result->code);
    }
}
