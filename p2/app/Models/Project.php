<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function employee()
    {
        return $this->belongsTo(employee::class);
    }

    public function projectPhases()
    {
        return $this->hasMany(ProjectPhase::class);
    }

    // Define other relationships if any
}
