<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
    protected $table = 'enrollment';
    public $timestamps = false;

    protected $fillable = [
        'department',
        'level',
        'semester',
        'start_date',
        'end_date',
    ];
    protected $casts = [
        'start_date' => 'date', // Cast to date
        'end_date' => 'date',   // Cast to date
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department');
    }
}
