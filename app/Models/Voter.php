<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function selection()
    {
        return $this->belongsTo(Selections::class, 'selections_id');
    }
}
