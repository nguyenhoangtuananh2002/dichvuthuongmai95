<?php

namespace App\Api\V1\Http\Requests\Employee;

use App\Api\V1\Http\Requests\BaseRequest;

class EmployeeLoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }
}
