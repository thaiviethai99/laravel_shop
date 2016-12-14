<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Image;
use Mail;
use Cart;
class WellcomeController extends Controller
{
    public function index(){
        //Cart::destroy();
        //$content = Cart::content();
        //print_r($content);
    	$product = DB::table('products')->select('id','name','price','image','alias')->orderBy('id','DESC')->skip(0)->take(4)->get();
    	return view('user.pages.home',compact('product'));
    }

    public function loaisanpham($id){
        $product_cate = DB::table('products')->select('id','name','price','image','alias','cate_id')->where('cate_id',$id)->orderBy('id','DESC')->paginate(2);
        $cate = DB::table('cates')->select('parent_id')->where('id',$id)->first();
        $menu_cate = DB::table('cates')->select('id','name','alias')->where('parent_id',$cate->parent_id)->get();
        $lasted_product = DB::table('products')->select('id','name','alias','image','price','cate_id')->orderBy('id','DESC')->take(3)->get();
    	return view('user.pages.cate',compact('product_cate','menu_cate','lasted_product'));
    }

    public function chitietsanpham($id){
    	$product_detail = DB::table('products')->where('id',$id)->first();
    	$image_product = DB::table('product_images')->where('product_id',$id)->get();
    	$product_cate = DB::table('products')->where('cate_id',$product_detail->cate_id)->where('id','<>',$id)->take(4)->get();
    	return view('user.pages.detail',compact('product_detail','image_product','product_cate'));
    }

    public function lienhe(){
    	return view('user.pages.contact');
    }

    public function postLienHe(Request $request){
    	$data = ['hoten'=>$request->name,'mess'=>$request->message];
    	//print_r($data);die();
    	Mail::send('user.mail.contact',$data,function($mess){
    		$mess->from('haidaica99999@gmail.com','hai dai ca');
    		$mess->to('thaiviethai99@gmail.com','viet hai')->subject('Day la mail viet hai');
    	});
    	echo "<script>
    	alert('Cam on ban da gop y.Chung toi se lien he lai voi ban trong thoi gian som nhat');
    	window.location = '".url('/')."'
    		</script>";
    }

    public function muahang($id){
    	$productBuy = DB::table('products')->where('id',$id)->first();
    	Cart::add(['id'=>$id,'name'=>$productBuy->name,'qty'=>1,'price'=>$productBuy->price,'options' => ['img' => $productBuy->image]]);
        return redirect()->route('giohang');
    }

    public function giohang(){
        $content = Cart::content();
        print_r($content);
        $total = Cart::total();
        return view('user.pages.shopping_cart',compact('content','total'));
    }

    public function xoasanpham($id){
        Cart::remove($id);
        return redirect()->route('giohang');
    }

}
