<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    protected $hidden = ['IdCategory'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'IdCategory');
    }
}
