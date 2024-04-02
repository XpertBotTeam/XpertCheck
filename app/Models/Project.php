<?php

namespace App\Models;
use App\Models\ProjectPhase;
use App\Models\Employee;
use App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function employeeprojectAssignment()
    {
        return $this->belongsToMany(EmployeeProjectAssignments::class, 'employeeprojectassignments', 'project_id', 'employee_id')
                    ->withTimestamps();
    }

    public function projectPhases()
    {
        return $this->hasMany(ProjectPhase::class);
    }

    // Define other relationships if any
}
