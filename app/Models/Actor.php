<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'birthdate',
        'country',
        'img_url',
    ];

    /**
     * Relación muchos a muchos con Film
     */
    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_actor');
    }
}
