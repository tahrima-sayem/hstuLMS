<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTaken extends Model
{
    use HasFactory;
    protected $table = 'Course_Taken';

    protected $guarded = ['created_at', 'updated_at'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'Student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'Course_id');
    }
}
