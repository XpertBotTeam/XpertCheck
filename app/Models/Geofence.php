<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geofence extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'latitude1',
        'longitude1',
        'latitude2',
        'longitude2',
        'latitude3',
        'longitude3',
        'latitude4',
        'longitude4',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // Add attributes here that you don't want to show in responses.
    ];

    public function employeeTimeLogs()
    {
        return $this->hasMany(EmployeeTimeLog::class);
    }
}
