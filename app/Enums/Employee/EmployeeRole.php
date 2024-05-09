<?php

namespace App\Enums\Employee;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Employee()
 * @method static static Driver()

 */
final class EmployeeRole extends Enum implements LocalizedEnum
{
    const Employee = 1;
    const Driver = 2;

}
