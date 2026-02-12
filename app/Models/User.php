<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'no_wa',
        'profile_photo',
        'google_id',
        'avatar',
        'password',
        'last_activity',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_activity' => 'datetime',
    ];

    public function isOnline()
    {
        return $this->last_activity && $this->last_activity->gt(now()->subSeconds(5));
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function kehadiran() 
    {
        return $this->hasMany(Kehadiran::class);
    }
    public function materi() 
    {
        return $this->hasMany(Materi::class);
    }

    public function muthabaahs()
    {
        return $this->hasMany(Muthabaah::class);
    }
}
