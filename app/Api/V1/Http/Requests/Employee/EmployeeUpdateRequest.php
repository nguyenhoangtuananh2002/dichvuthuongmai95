<?php

namespace App\Api\V1\Http\Requests\Employee;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Enums\Employee\{EmployeeRole,EmployeeGender};
use BenSampo\Enum\Rules\EnumValue;

class EmployeeUpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPut()
    {
        return [
            'fullname' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:App\Models\Employee,email,'.$this->user()->id],
            'gender' => ['required', new EnumValue(EmployeeGender::class, false)],
            'address' => ['nullable'],
            'roles' => ['required', new EnumValue(EmployeeRole::class, false)],
        ];
    }
}
