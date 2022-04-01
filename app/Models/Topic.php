<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $table = 'topics';
    
    protected $fillable = [
        'name',
        'subsection_id'
    ];

    public function subsection()
    {
        return $this->belongsTo('App\Models\Subsection')->get();
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post')->get();
    }
}
