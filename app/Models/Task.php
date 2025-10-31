<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'isCompleted',
    ];
    protected $attributes = [
    'isCompleted' => false,
    ];

}
