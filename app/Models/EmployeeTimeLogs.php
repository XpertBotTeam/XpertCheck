<?php

namespace App\Models;
use App\Models\Project;
use App\Models\Employee;

use Illuminate\Database\Eloquent\Model;

class EmployeeTimeLogs extends Model
{

    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Inside the EmployeeTimeLogs model
    public function geofence()
    {
        return $this->belongsTo(\App\Models\Geofence::class);
    }


    // Define other relationships if any
}
