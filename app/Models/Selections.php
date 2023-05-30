<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selections extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'start_date',
        'end_date',
    ];

    public function voter()
    {
        return $this->hasMany(Voter::class);
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function votes()
    {
        return $this->hasOne(Vote::class);
    }
}
