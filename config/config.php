<?php

/*
             * You can place your custom package configuration in here.
     */
return [

    /**
     * Default expiration time for inivite in hours.
     */
    'expiration' => 48,

    /**
     * User model.
     */
    'model' => env('USER_MODEL', App\Models\User::class),

    /**
     * Invitation model.
     */
    'invite-model' => env('INVITE_MODEL', Distortion\LaravelInvite\Models\InviteModel::class),

];
