<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at'];
    protected $fillable = ['course_id', 'teacher_id', 'session'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // Define the relationship to the Teacher model
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
