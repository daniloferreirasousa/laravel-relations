<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course\{
    Course
};

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color'];

    public function users()
    {
        return $this->morphedByMany(User::class, 'tagable');
    }

    public function courses()
    {
        return $this->morphedByMany(Course::class, 'tagable');
    }
}
