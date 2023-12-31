<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Polimorfic\{
    Comment
};
use App\Models\{
    Tag
};

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'available'
    ];

    public function modules()
    {
        return $this->hasMany(Module::class);
    }


    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'tagable');
    }
}
