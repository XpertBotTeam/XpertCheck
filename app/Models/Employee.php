<?php

namespace App\Models;
use App\Models\Project;
use App\Models\EmployeeTimeLog;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'employeeprojectassignments', 'employee_id', 'project_id')
                    ->withTimestamps();
    }

    public function timeLogs()
{
    return $this->hasMany(EmployeeTimeLog::class);
}

}

