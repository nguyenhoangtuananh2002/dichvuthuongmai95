<?php

namespace App\Api\V1\Http\Requests\Employee;

use App\Api\V1\Http\Requests\BaseRequest;

class EmployeeResetPasswordRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

     protected function methodPost()
     {
         return [
             'email' =>['required', 'exists:App\Models\Employee,email']
         ];
     }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    protected function methodPut()
    {
        return [
            'password' => ['required', 'string', 'max:255', 'confirmed'],
        ];
    }
}
