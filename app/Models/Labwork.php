<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labwork extends Model
{
    use HasFactory;
    protected $table = 'labwork';
    public $timestamps = false; 

    protected $guarded = ['created_at', 'updated_at'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'Course_id');
    }

    public function solutions()
    {
        return $this->hasMany(SolutionLabwork::class, 'Labwork_id');
    }
}
