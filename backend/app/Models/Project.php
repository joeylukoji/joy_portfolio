<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title',
    'category',
    'color',
    'image',
    'description',
    'skills',
    'details',
    'link',
])]
class Project extends Model
{
    protected function casts(): array
    {
        return [
            'skills' => 'array',
            'details' => 'array',
        ];
    }
}
