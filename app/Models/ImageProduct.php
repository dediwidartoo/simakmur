<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    protected $table = 'images_product';

    
    protected $guarded = ['id'];

    public function productRelation()
    {
        return $this->hasOne('App\Models\Product','id','produk_id');
    }
}
