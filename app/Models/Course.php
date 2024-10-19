<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];
    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    public function distributions()
    {
        return $this->hasMany(Distribution::class);
    }
    public function studentsTaken()
    {
        return $this->hasMany(CourseTaken::class, 'Course_id');
    }
    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'Course_id');
    }
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function labWorks()
    {
        return $this->hasMany(Labwork::class);
    }
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
    public function materials()
    {
        return $this->hasMany(Material::class);
    }
    public function assignExternals()
    {
        return $this->hasMany(AssignExternal::class);
    }
}
