<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendence';

    protected $guarded = ['created_at', 'updated_at'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'Student_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'Class_id');
    }
}
