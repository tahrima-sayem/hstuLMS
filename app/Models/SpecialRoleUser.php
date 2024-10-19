<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialRoleUser extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at'];
    protected $fillable = ['user_id', 'special_role_id'];

    public function special_role()
    {
        return $this->belongsTo(SpecialRoleUser::class, 'special_role_id');
    }

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
