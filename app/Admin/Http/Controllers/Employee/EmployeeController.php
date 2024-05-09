<?php

namespace App\Admin\Http\Controllers\Employee;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Employee\EmployeeRequest;
use App\Admin\Repositories\Employee\EmployeeRepositoryInterface;
use App\Admin\Services\Employee\EmployeeServiceInterface;
use App\Admin\DataTables\Employee\EmployeeDataTable;
use App\Models\DriverRating;
use App\Models\Employee;
use App\Enums\Employee\{EmployeeRole, EmployeeGender};

class EmployeeController extends Controller
{
    public function __construct(
        EmployeeRepositoryInterface $repository,
        EmployeeServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;

        $this->service = $service;

    }

    public function getView(){
        return [
            'index' => 'admin.employee.index',
            'create' => 'admin.employee.create',
            'edit' => 'admin.employee.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.employee.index',
            'create' => 'admin.employee.create',
            'edit' => 'admin.employee.edit',
            'delete' => 'admin.employee.delete'
        ];
    }
    public function index(EmployeeDataTable $dataTable){
        return $dataTable->render($this->view['index'], [
            'roles' => EmployeeRole::asSelectArray(),
            'gender' => EmployeeGender::asSelectArray()
        ]);
    }

    public function create(){
        return view($this->view['create'], [
            'roles' => EmployeeRole::asSelectArray(),
            'gender' => EmployeeGender::asSelectArray()
        ]);
    }

    public function store(EmployeeRequest $request){

        $instance = $this->service->store($request);

        return to_route($this->route['edit'], $instance->id);

    }

    public function edit($id)
    {

        $instance = $this->repository->findOrFail($id);
        $ratings = DriverRating::where('driver_id', $id)->get();
        // Ensure that 'driver_id' is the correct foreign key
        $averageRating = $instance->driverRatings->avg('rating');
        $apiKey = env('GOOGLE_MAPS_API_KEY');

        return view(
            $this->view['edit'],
            [
                'employee' => $instance,
                'roles' => EmployeeRole::asSelectArray(),
                'gender' => EmployeeGender::asSelectArray(),
                'ratings' => $ratings,
                'averageRating' => $averageRating,// Pass ratings to the view
                'apiKey' => $apiKey

            ]
        );

    }
    public function updateLocation(EmployeeRequest $request, Employee $employee)
    {
        $validated = $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);

        $employee->update([
            'lat' => $validated['lat'],
            'lng' => $validated['lng'],
        ]);

        return response()->json(['message' => 'Location updated successfully!']);
    }






    public function update(EmployeeRequest $request){

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));

    }
}
