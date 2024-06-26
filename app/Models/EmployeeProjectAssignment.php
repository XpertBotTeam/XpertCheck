<?php

namespace App\Models;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;

class EmployeeProjectAssignment extends Model
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
