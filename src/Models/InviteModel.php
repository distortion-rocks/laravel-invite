<?php

namespace Distortion\LaravelInvite\Models;

use Distortion\LaravelInvite\Concerns\Status;
use Illuminate\Database\Eloquent\Model;

class InviteModel extends Model
{
    use Status;

    protected $table = 'invites';

    protected $guarded = [];

    protected $casts = [
        'expires' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(config('laravelinvite.model'));
    }
}
