<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['title', 'course_id', 'description', 'file', 'deadline'];


    public function course()
    {
        return $this->belongsTo(Course::class, 'Course_id');
    }

    public function solutions()
    {
        return $this->hasMany(SolutionAssignment::class, 'Assignment_id');
    }
}
