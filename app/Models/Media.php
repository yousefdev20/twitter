<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $table = 'medias';

    protected $fillable = ['path', 'mediable_id', 'mediable_type', 'resource_type'];

    public function path(): Attribute
    {
        return Attribute::make(
            get: fn($value) => url($value),
            set: fn($value) => str_replace('public', 'storage', $value),
        );
    }
}
