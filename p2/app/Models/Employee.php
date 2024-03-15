<?php

namespace App;
use App\Models\User;
use App\Models\TimeLog;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function timeLogs()
{
    return $this->hasMany(TimeLog::class);
}

}

