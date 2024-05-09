<?php

namespace App\Enums\Employee;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Male()
 * @method static static Female()
 * @method static static Other()
 */
final class EmployeeGender extends Enum implements LocalizedEnum
{
    const Male = 1;
    const Female = 2;
    const Other = 3;
}
