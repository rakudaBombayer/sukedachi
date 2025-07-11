<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users';
    protected $primaryKey = 'user_ID';
    protected $fillable = [
        'user_ID',
        'nickname',
        'profile_image',
        'email',
        'password',
        'address',
        'self_introduction',
        // 他の許可したいカラムも追加
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class, 'user_ID');
    }

    public function requests()
    {
        return $this->hasMany(Request::class, 'user_ID');
    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class, 'user_ID');
    }
}
