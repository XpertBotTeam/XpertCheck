<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectPhase extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Define other relationships if any
}
