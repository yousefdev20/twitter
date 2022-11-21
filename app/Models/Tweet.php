<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    protected $fillable = ['content', 'user_id', 'replays_on_id'];

    protected $with = ['replays', 'user:id,name,nick_name,avatar', 'media'];

    public function scopeTweetsFeed($query)
    {
        $query->where('active', 1);
    }

    public function replays()
    {
        return $this->hasMany(Tweet::class, 'replays_on_id', 'id');
    }

    public function likes()
    {
        return $this->belongsToMany(Tweet::class, 'tweet_like', 'tweet_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->morphOne(Media::class, 'mediable');
    }

    public function hasLiked()
    {
        return $this->belongsToMany(Tweet::class, 'tweet_like', 'tweet_id')->where('tweet_like.user_id', auth()->id());
    }
}
