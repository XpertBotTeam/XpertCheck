<?php

namespace App\Models;
use App\Models\Project;
use App\Models\EmployeeTimeLog;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable=['salary','user_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getNameAttribute()
    {
        return $this->user->name;
    }

    public function getEmailAttribute()
    {
        return $this->user->email;
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

