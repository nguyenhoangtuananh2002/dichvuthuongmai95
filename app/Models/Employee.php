<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\Employee\{EmployeeRole, EmployeeGender};
use Illuminate\Support\Facades\DB;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'username',
        'fullname',
        'email',
        'phone',
        'address',
        'gender',
        'token_get_password',
        'password',
        'roles',
        'license_number',
        'vehicle_type',
        'lng',
        'lat'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles' => EmployeeRole::class,
        'gender' => EmployeeGender::class,
        'active' => 'boolean'
    ];
    public function driverRatings()
    {

            return $this->hasMany(DriverRating::class, 'driver_id');
    }


}
