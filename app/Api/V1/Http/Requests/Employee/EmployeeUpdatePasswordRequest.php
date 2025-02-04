<?php

namespace App\Api\V1\Http\Requests\Employee;

use App\Api\V1\Http\Requests\BaseRequest;

class EmployeeUpdatePasswordRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    protected function methodPut()
    {
        return [
            'old_password' =>['current_password'],
            'password' => ['required', 'string', 'confirmed'],
        ];
    }
}
