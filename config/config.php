<?php

/*
 * You can place your custom package configuration in here.
 */
return [

    /**
     * Default expiration time period
     * Time defined in hours.
     */
    'expire' => 48,

    /**
     * User model.
     */
    'model' => env('USER_MODEL', App\Models\User::class),

    /**
     * Invitation model.
     */
    'invite-model' => env('INVITE_MODEL', Distortion\LaravelInvite\Models\InviteModel::class),

];
