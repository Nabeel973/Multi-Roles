<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    //assign  a role to a user
    public function assignRole($role)
    {

        if(is_string($role))
        {
            $role=Role::whereName($role)->firstOrFail();
        }

        //for removing the error of p.k of role in pivot table
        $this->roles()->sync($role,false);
    }

    //for getting the ability of user.
    public function abilities()
    {
        return $this->roles->map->abilities->flatten()->pluck('name')->unique();
    }


}
