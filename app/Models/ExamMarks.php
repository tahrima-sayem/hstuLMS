<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamMarks extends Model
{
    use HasFactory;
    protected $table = 'exam_mark';
    public $timestamps = false; 
    protected $guarded = ['created_at', 'updated_at'];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'Exam_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'Student_id');
    }
}
