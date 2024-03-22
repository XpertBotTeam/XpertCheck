<?php

namespace App\Models;
use App\Models\Project;
use App\Models\Employee;

use Illuminate\Database\Eloquent\Model;

class EmployeeTimeLog extends Model
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

    // Define other relationships if any
}
