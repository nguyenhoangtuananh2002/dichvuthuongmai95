<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverRating extends Model
{
    protected $fillable = ['driver_id', 'user_id', 'rating', 'review'];

    /**
     * Get the driver who was rated.
     */
    public function driver()
    {
        return $this->belongsTo(Employee::class, 'driver_id');
    }

    /**
     * Get the user who left the rating.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

