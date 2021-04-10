<?php

namespace Distortion\LaravelInvite\Database\Factories;

use Carbon\Carbon;
use Distortion\LaravelInvite\Enums\InviteStatus;
use Distortion\LaravelInvite\Models\InviteModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class InviteFactory extends Factory
{
    protected $model = InviteModel::class;

    public function definition()
    {
        return [
            'code' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'email' => $this->faker->email,
            'user_id' => 1,
            'status' => InviteStatus::pending()->value,
            'expires' => Carbon::now()->addHours(48)
        ];
    }
}
