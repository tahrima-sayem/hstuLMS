<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $table = 'exam';
    public $timestamps = false; 

    protected $guarded = ['created_at', 'updated_at'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'Course_id');
    }

    public function examMarks()
    {
        return $this->hasMany(ExamMarks::class);
    }
}
