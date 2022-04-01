<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'name',
        'content',
        'topic_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User')->select(array('id', 'name', 'email'))->get();
    }

    public function topic()
    {
        return $this->belongsTo('App\Models\Topic')->get();
    }
}
