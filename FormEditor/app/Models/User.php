<?php

namespace App\Models;

use App\Models\Role;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'password',
        'current_team_id',
        'profile_photo_path',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'role_id',
    ];

    protected $dates = [
        'created_at',
        'deleted_at',
        'started_at',
        'update_at'
    ];

    public function forms()
    {
        return $this->hasMany(Forms::class);
    }

    public function formGroupe()
    {
        return $this->belongsToMany(Forms::class);
    }

    public function role()
    {
        //return $this->hasMany(Role::class, 'id', 'role_id');
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    // public function __construct(array $attributes = [])
    // {
    //     parent::__construct($attributes);
    //     self::created(function (User $user) {
    //         if (!$user->role()->get()->contains(2)) {
    //             $user->role()->attach(3);
    //         }
    //     });
    // }
}
