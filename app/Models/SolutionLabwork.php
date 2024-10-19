<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionLabwork extends Model
{
    use HasFactory;
    protected $table = 'solution_labwork';
    public $timestamps = false; 
    protected $guarded = ['created_at', 'updated_at'];

    public function labwork()
    {
        return $this->belongsTo(Labwork::class, 'Labwork_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'Student_id');
    }
}
