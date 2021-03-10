<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'posts';

    protected $guarded = ['id'];

    public function Kategori()
    {
        return $this->belongsTo(\App\Models\Category::class, 'kategori_id','id');
    }
}
