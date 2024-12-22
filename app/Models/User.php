<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles,SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'optional1', 'optional2','avatar_url',
        'active',
        
    ];

    protected $dates = ['deleted_at']; 
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


    public function scopeRole($query, $roleName)
    {
        return $query->whereHas('role', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        });
    }

    // Relation to Role model (assuming you have one)
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function blogs()
    {
        return $this->hasMany(blog::class);
    }
}
