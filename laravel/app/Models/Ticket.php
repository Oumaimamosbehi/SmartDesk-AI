<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'description',
        'category',
        'priority',
        'status',
        'ai_solution',
        'ai_confidence',
    ];
}
