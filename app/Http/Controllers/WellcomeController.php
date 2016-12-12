<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Image;
class WellcomeController extends Controller
{
    public function index(){
    	$product = DB::table('products')->select('id','name','price','image','alias')->orderBy('id','DESC')->skip(0)->take(4)->get();
    	return view('user.pages.home',compact('product'));
    }

    public function loaisanpham($id){
        $product_cate = DB::table('products')->select('id','name','price','image','alias','cate_id')->where('cate_id',$id)->orderBy('id','DESC')->paginate(2);;
    	return view('user.pages.cate',compact('product_cate'));
    }

}
