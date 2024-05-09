<?php

namespace App\Api\V1\Repositories\Employee;
use App\Admin\Repositories\EloquentRepository;
use App\Api\V1\Repositories\Employee\EmployeeRepositoryInterface;
use App\Models\Employee;

class EmployeeRepository extends EloquentRepository implements EmployeeRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return Employee::class;
    }
    public function findByKey($key, $value){
        $this->instance = $this->model->where($key, $value)->first();
        return $this->instance;
    }

    public function updateObject($employee, $data){
        $employee->update($data);
        return $employee;
    }
}
