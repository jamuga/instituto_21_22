<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
