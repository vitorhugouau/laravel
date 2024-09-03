<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class usuarios extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios'; // Explicitamente define o nome da tabela

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}

