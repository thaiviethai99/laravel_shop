<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['id','name','alias','price','intro','content','image','keywords','description','user_id','cate_id'];
    public $timestamps = false;

    public function cate(){
    	return $this->belongsTo('App\Cate');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function images(){
    	return $this->hasMany('App\ProductImage','product_id');
    }
}