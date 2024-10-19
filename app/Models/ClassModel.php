<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'classes'; 

    protected $guarded = ['created_at', 'updated_at'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'Course_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'Class_id');
    }
}
