<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $fillable = ['id', 'image', 'product_id'];
    //protected $hidden = ['created_at', 'updated_at','giangvien'];
    public $timestamps = false;

    public function product(){
    	return $this->belongsTo('App\Product','product_id');
    }
}
