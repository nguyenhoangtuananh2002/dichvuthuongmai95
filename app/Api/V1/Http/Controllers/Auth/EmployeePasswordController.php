<?php

namespace App\Api\V1\Http\Controllers\Auth;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Services\EmployeeAuth\EmployeeAuthServiceInterface;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\Employee\EmployeeResetPasswordRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Api\V1\Mail\Auth\ResetPassword;
use App\Api\V1\Repositories\Employee\EmployeeRepositoryInterface;
use App\Api\V1\Services\Employee\EmployeeServiceInterface;

/**
 * @group Người dùng
 */
class EmployeePasswordController extends Controller
{
    //
    public function __construct(
        EmployeeRepositoryInterface $repository,
        EmployeeAuthServiceInterface $service
    )
    {
        parent::__construct();
        $this->repository = $repository;
        $this->service = $service;
    }
    public function getRoute()
    {
        return [
            'edit' => 'password.reset.edit',
        ];
    }

    /**
     * Lấy lại mật khẩu
     *
     * Lấy lại mật khẩu khi người dùng quên mật khẩu.
     *
     *
     * @bodyParam email string required
     * Email Của bạn. Example: example@gmail.com
     *
     * @response {
     *      "status": 200,
     *      "message": "Thực hiện thành công. Vui lòng kiểm tra email của bạn để lấy lại mật khẩu."
     * }
     *
     * @param EMployeeResetPasswordRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAndSendMail(EmployeeResetPasswordRequest $request){
        $instance = $this->service->updateTokenPassword($request)
        ->generateRouteGetPassword($this->route['edit'])
        ->getInstance();

        Mail::to($instance['employee'])->send(new ResetPassword($instance['employee'], $instance['url']));

        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công. Vui lòng kiểm tra email của bạn để lấy lại mật khẩu.')
        ]);
    }
}
