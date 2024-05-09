<?php

namespace App\Api\V1\Services\EmployeeAuth;

use App\Api\V1\Services\EmployeeAuth\EmployeeAuthServiceInterface;
use  App\Api\V1\Repositories\Employee\EmployeeRepositoryInterface;
use Illuminate\Http\Request;
use App\Admin\Traits\Setup;
use App\Enums\Employee\{EmployeeRole,EmployeeGender};
use Illuminate\Support\Facades\URL;

class EmployeeAuthService implements EmployeeAuthServiceInterface
{
    use Setup;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    protected $instance;

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

    public function updateTokenPassword(Request $request){
        $employee  = $this->repository->findByKey('email', $request->input('email'));
        $this->data['token_get_password'] = $this->generateTokenGetPassword();
        $this->instance['employee'] = $this->repository->updateObject($employee, $this->data);
        return $this;
    }

    public function generateRouteGetPassword($routeName){
        $this->instance['url'] = URL::temporarySignedRoute(
            $routeName, now()->addMinutes(30), [
                'token' => $this->data['token_get_password'],
                'code' => $this->instance['employee']->code
            ]
        );
        return $this;
    }

    public function getInstance(){
        return $this->instance;
    }
}
