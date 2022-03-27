<?php

namespace App\Models;

use App\Helper\RedirectHelper;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Akunbeben\FortifyRole\Traits\HasRole;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRole;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'instance',
        'profession',
        'is_admin',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function quiz()
    {
        return $this->hasMany(Quiz::class, 'user_id', 'id');
    }

    public function studies()
    {
        return $this->hasMany(Studies::class, 'user_id', 'id');
    }

}
