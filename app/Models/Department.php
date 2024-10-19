<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at'];

    public function chairman()
    {
        return $this->hasOne(User::class);
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'department');
    }
}
