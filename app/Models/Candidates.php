<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidates extends Model
{
    use HasFactory;

    protected $fillable = ['id_selections', 'name', 'visi', 'misi', 'photo'];

    public function selection()
    {
        return $this->belongsTo(Selections::class);
    }

    public function votes()
    {
        return $this->hasOne(Vote::class);
    }
}
