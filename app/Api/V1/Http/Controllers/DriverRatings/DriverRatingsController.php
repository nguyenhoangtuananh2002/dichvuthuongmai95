<?php

namespace App\Api\V1\Http\Controllers\DriverRatings;
use App\Enums\Employee\EmployeeRole;
use App\Http\Controllers\Controller;
use App\Models\DriverRating;
use App\Models\Employee;
use Illuminate\Http\Request;

class DriverRatingsController extends Controller
{
    public function index()
    {
        // You might want to add pagination and filters
        return DriverRating::with('driver', 'user')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|exists:employees,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|between:1,5',
            'review' => 'nullable|string'
        ]);

        $driver = Employee::find($request->driver_id);



        // Ensure the employee is a driver
        if ($driver->roles->value !== EmployeeRole::Driver) {
            return response()->json(['message' => 'The selected employee is not a driver'], 400);
        }

        $rating = DriverRating::create($request->all());

        return response()->json($rating, 201);
    }


    public function show(DriverRating $driverRating)
    {
        return $driverRating->load('driver', 'user');
    }

    public function update(Request $request, DriverRating $driverRating)
    {
        $request->validate([
            'rating' => 'integer|between:1,5',
            'review' => 'nullable|string'
        ]);

        $driverRating->update($request->all());

        return response()->json($driverRating);
    }

    public function destroy(DriverRating $driverRating)
    {
        $driverRating->delete();

        return response()->json(['message' => 'Driver rating deleted successfully']);
    }
}
