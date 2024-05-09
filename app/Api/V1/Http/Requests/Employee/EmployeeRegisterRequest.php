<?php

namespace App\Api\V1\Http\Requests\Employee;

use App\Api\V1\Http\Requests\BaseRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\Employee\{EmployeeGender, EmployeeRole};

class EmployeeRegisterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'fullname' => ['required', 'string'],
            'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\Employee,phone'],
            'email' => ['required', 'email', 'unique:App\Models\Employee,email'],
            'password' => ['required', 'string', 'confirmed'],
            'gender' => ['required', new EnumValue(EmployeeGender::class, false)],
            'roles' => ['required', new EnumValue(EmployeeRole::class, false)],
        ];
    }
}
