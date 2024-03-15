<?php

namespace App;

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
