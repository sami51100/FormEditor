<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_nom',
    ];

    public function users()
    {
        // return $this->hasMany('App\Models\User', 'role_id', 'id');
        return $this->hasMany(User::class, 'role_nom', 'id');
    }
}
