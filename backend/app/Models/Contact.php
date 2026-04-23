<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'full_name',
    'email',
    'subject',
    'message',
])]
class Contact extends Model
{
}
