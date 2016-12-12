<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CateRequest;
use App\Cate;
use App\Helper\Helper;
class CateController extends Controller
{
    public function getAdd(){
    	$parent = Cate::select('id','name','parent_id')->get()->toArray();
    	return view('admin.cate.add',compact('parent'));
    }

    public function postAdd(CateRequest $request){
    	$cate = new Cate;
    	$cate->name = $request->txtCateName;
    	$cate->alias = Helper::convert2Alias($request->txtCateName);
    	$cate->order = $request->txtOrder;
    	$cate->parent_id = $request->slcParent;
    	$cate->keywords = $request->txtKeywords;
    	$cate->description = trim($request->txtDescription);
    	$cate->save();
    	return redirect()->route('admin.cate.list')->with(['level'=>'success','message'=>'Add success']);
    }

    public function getList(){
    	$data = Cate::select('id','name','parent_id')->orderBy('id','DESC')->get()->toArray();
    	return view('admin.cate.list',compact('data'));
    }

    public function getDelete($id){
    	$cate = Cate::find($id);
		$cate->delete();
		return redirect()->route('admin.cate.list');
    }

    public function getEdit($id){
        $parent = Cate::select('id','name','parent_id')->get()->toArray();
        $data = Cate::find($id)->toArray();
    	return view('admin.cate.edit',compact('data','parent'));
    }

    public function postEdit(CateRequest $request,$id){
        $cate = Cate::find($id);
        $cate->name = $request->txtCateName;
        $cate->alias = Helper::convert2Alias($request->txtCateName);
        $cate->order = $request->txtOrder;
        $cate->parent_id = $request->slcParent;
        $cate->keywords = $request->txtKeywords;
        $cate->description = trim($request->txtDescription);
        $cate->save();
        return redirect()->route('admin.cate.list')->with(['level'=>'success','message'=>'Update success']);
    }

}
