<?php

namespace App\Models;
use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
    ];

    protected $hidden = [
    ];

    protected $casts = [
       
    ];
    public $timestamps = false;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // Define other relationships if any
}
