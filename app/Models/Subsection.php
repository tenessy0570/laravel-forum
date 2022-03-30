<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsection extends Model
{
    use HasFactory;

    protected $table = 'subsections';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'section_id'
    ];
}
