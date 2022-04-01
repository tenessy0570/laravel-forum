<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function subsections()
    {
        return $this->hasMany('App\Models\Subsection')->get();
    }
}
