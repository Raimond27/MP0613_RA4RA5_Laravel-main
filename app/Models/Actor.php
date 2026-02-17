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
        'alias',
    ];

    /**
     * Relación muchos a muchos con Film
     */
    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_actor');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($actor) {
            if (empty($actor->alias)) {
                $actor->alias = \Illuminate\Support\Str::slug($actor->name . ' ' . $actor->surname);
            }
        });
    }
}
