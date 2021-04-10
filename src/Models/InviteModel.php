<?php

namespace Distortion\LaravelInvite\Models;

use Distortion\LaravelInvite\Concerns\Status;
use Distortion\LaravelInvite\Database\Factories\InviteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InviteModel extends Model
{
    use HasFactory;
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

    protected static function newFactory()
    {
        return InviteFactory::new();
    }
}
