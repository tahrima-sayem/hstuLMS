<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignExternal extends Model
{
    use HasFactory;
    protected $table = 'assigned_externals';
    public $timestamps = false; 
    protected $guarded = ['created_at', 'updated_at'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function external()
    {
        return $this->belongsTo(External::class);
    }

    public function examCommittees()
    {
        return $this->hasMany(ExamCommittee::class);
    }
}
