<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
    
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
