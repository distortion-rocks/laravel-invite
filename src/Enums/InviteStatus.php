<?php

namespace Distortion\LaravelInvite\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self pending()
 * @method static self successful()
 * @method static self canceled()
 * @method static self expired()
 */
class InviteStatus extends Enum
{
}
