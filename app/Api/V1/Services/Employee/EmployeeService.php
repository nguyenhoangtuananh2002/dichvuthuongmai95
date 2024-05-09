<?php

namespace App\Api\V1\Services\Employee;

use App\Api\V1\Services\Employee\EmployeeServiceInterface;
use  App\Api\V1\Repositories\Employee\EmployeeRepositoryInterface;
use Illuminate\Http\Request;
use App\Admin\Traits\Setup;
use App\Enums\Employee\EmployeeGender;
use App\Enums\Employee\EmployeeRole;

class EmployeeService implements EmployeeServiceInterface
{
    use Setup;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(EmployeeRepositoryInterface $repository){
        $this->repository = $repository;
    }

    public function store(Request $request){

        $this->data = $request->validated();
        $this->data['username'] = $this->data['phone'];
        $this->data['code'] = $this->createCodeUser();
        $this->data['roles'] = EmployeeRole::Driver();
        $this->data['gender'] = EmployeeGender::Male();
        $this->data['password'] = bcrypt($this->data['password']);
        return $this->repository->create($this->data);
    }

    public function update(Request $request){

        $this->data = $request->validated();

        if(isset($this->data['password']) && $this->data['password']){
            $this->data['password'] = bcrypt($this->data['password']);
        }else{
            unset($this->data['password']);
        }

        return $this->repository->update($this->data['id'], $this->data);

    }

    public function delete($id){
        return $this->repository->delete($id);

    }

}
