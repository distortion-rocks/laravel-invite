<?php

/*
 * You can place your custom package configuration in here.
 */
return [

    /**
     * Default expiration time period
     * Time defined in hours
     */
    'expire' => 48,

    /**
     * User model
     */
    'Model' => App\Models\User::class,

    /**
     * Invitation model
     */
    'InviteModel' => Distortion\LaravelInvite\Models\InviteModel::class

];