<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Developer()
 * @method static static SuperAdmin()
 * @method static static Member()
 */
final class Roles extends Enum
{
    const Developer =   'Developer';
    const SuperAdmin =   'Super Admin';
    const Member = 'Member';
}
