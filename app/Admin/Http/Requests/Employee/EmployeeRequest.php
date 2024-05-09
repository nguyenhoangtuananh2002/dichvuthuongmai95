<?php

namespace App\Admin\Http\Requests\Employee;

use App\Admin\Http\Requests\BaseRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\Employee\{EmployeeRole, EmployeeGender};

class EmployeeRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            // 'username' => [
            //     'required',
            //     'string', 'min:6', 'max:50',
            //     'unique:App\Models\User,username',
            //     'regex:/^[A-Za-z0-9_-]+$/',
            //     function ($attribute, $value, $fail) {
            //         if (in_array(strtolower($value), ['admin', 'user', 'password'])) {
            //             $fail('The '.$attribute.' cannot be a common keyword.');
            //         }
            //     },
            // ],
            'fullname' => ['required', 'string'],
            'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\Employee,phone'],
            'email' => ['required', 'email', 'unique:App\Models\Employee,email'],
            'address' => ['nullable'],
            'gender' => ['required', new EnumValue(EmployeeGender::class, false)],
            'password' => ['required', 'string', 'confirmed'],
            'lat' => ['nullable'],
            'lgn' => ['nullable'],
            'roles' => ['required', new EnumValue(EmployeeRole::class, false)],
            'license_number' => ['nullable'],
            'vehicle_type' => ['nullable'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Employee,id'],
            // 'username' => [
            //     'required',
            //     'string', 'min:6', 'max:50',
            //     'unique:App\Models\User,username,'.$this->id,
            //     'regex:/^[A-Za-z0-9_-]+$/',
            //     function ($attribute, $value, $fail) {
            //         if (in_array(strtolower($value), ['admin', 'user', 'password'])) {
            //             $fail('The '.$attribute.' cannot be a common keyword.');
            //         }
            //     },
            // ],
            'fullname' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:App\Models\Employee,email,'.$this->id],
            'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\Employee,phone,'.$this->id],
            'address' => ['nullable'],
            'license_number' => ['nullable'],
            'lat' => ['nullable'],
            'lgn' => ['nullable'],
            'vehicle_type' => ['nullable'],
            'gender' => ['required', new EnumValue(EmployeeGender::class, false)],
            'password' => ['nullable', 'string', 'confirmed'],
            'roles' => ['required', new EnumValue(EmployeeRole::class, false)]

        ];
    }
}
