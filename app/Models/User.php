<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    private const DefaultAvatar = '/images/users/default_profile_400x400.png';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'avatar',
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
    ];

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url($value),
            set: fn ($value) => $value ?? self::DefaultAvatar,
        );
    }

    public function ownTweets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Tweet::class, 'user_id', 'id');
    }

    public function followers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'followee_id', 'follower_id');
    }

    public function followings(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followee_id');
    }

    public function tweets()
    {
        return $this->belongsToMany(Tweet::class, 'follows', 'followee_id', 'follower_id', 'id', 'user_id');
    }

    public function likes()
    {
        return $this->belongsToMany(Tweet::class, 'tweet_like', 'user_id');
    }

    public function hasLiked()
    {
        return $this->belongsToMany(Tweet::class, 'tweet_like', 'user_id')->where('user_id');
    }
}
