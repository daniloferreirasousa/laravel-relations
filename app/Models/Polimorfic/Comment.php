<?php

namespace App\Models\Polimorfic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'body'];

    public function commentable()
    {
        return $this->morphTo();
    }
}