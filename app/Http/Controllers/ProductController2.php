<?php

namespace App\Http\Controllers;

use App\Cate;
use App\Product;
use App\ProductImage;
use Auth;
use Illuminate\Http\Request;
use Validator;

//use Request;
class ProductController extends Controller
{
    public function getAdd()
    {
        //echo public_path();
        //echo dirname(dirname(__FILE__)); // /var/www
        //die();
        $parent = Cate::select('id', 'name', 'parent_id')->get()->toArray();
        return view('admin.product.add', compact('parent'));
    }

    public function postAdd(Request $request)
    {
        $v = Validator::make($request->all(), [
            'txtName'    => 'required|unique:products,name',
            'txtPrice'   => 'required',
            'txtIntro'   => 'required',
            'txtContent' => 'required',
            'avatar'     => 'required|image|max:500000',
            'slcCate'    => 'required',
        ],
            [
                'txtName.required'    => 'Ten khong duoc bo trong',
                'txtName.unique'      => 'Ten khong duoc trung',
                'txtPrice.required'   => 'Gia khong duoc bo trong',
                'txtIntro.required'   => 'Intro khong duoc bo trong',
                'txtContent.required' => 'Content khong duoc bo trong',
            ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        } else {
            $destinationPath = 'public/uploads'; // upload path
            $extension       = $request->avatar->getClientOriginalExtension(); // getting image extension
            $fileName        = rand(11111, 99999) . '.' . $extension; // renameing image
            $request->file('avatar')->move($destinationPath, $fileName);
            $product              = new Product;
            $product->name        = $request->txtName;
            $product->alias       = $request->txtAlias;
            $product->price       = $request->txtPrice;
            $product->intro       = $request->txtIntro;
            $product->content     = $request->txtContent;
            $product->image       = $fileName;
            $product->keywords    = $request->txtKeywords;
            $product->description = $request->txtDescription;
            $product->status      = $request->rdoStatus;
            $product->cate_id     = $request->slcCate;
            $product->user_id     = Auth::id();
            $save                 = $product->save();
            $insertId             = $product->id;
            // getting all of the post data
            $files = $request->file('images');
            //print_r($files);
            //die();
            // Making counting of uploaded images
            $file_count = count($files);
            // start count how many uploaded
            $uploadcount = 0;
            foreach ($files as $file) {
                $rules     = array('file' => 'required|image|max:500000');
                $validator = Validator::make(array('file' => $file), $rules);
                if ($validator->passes()) {
                    $destinationPath          = 'public/uploads';
                    $extension                = $file->getClientOriginalExtension(); // getting image extension
                    $fileName                 = rand(11111, 99999) . '.' . $extension; // renameing image
                    $upload_success           = $file->move($destinationPath, $fileName);
                    $productImage             = new ProductImage();
                    $productImage->image      = $fileName;
                    $productImage->product_id = $insertId;
                    $productImage->save();
                    $uploadcount++;
                }
            }
            if ($uploadcount == $file_count) {

                return redirect()->route('admin.product.list')->with(['level' => 'success', 'message' => 'Add success']);
            } else {
                return redirect()->back()->withInput()->withErrors($validator);
                /* return Redirect::to('admin/product/list')->withInput()->withErrors($validator);*/
            }
        }

    }

    public function getList(Request $request)
    {
        $data = Product::select()->orderBy('id', 'DESC')->get()->toArray();
        return view('admin.product.list', compact('data'));
    }

    public function getDelete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('admin.product.list');
    }

    public function getEdit($id)
    {
        $cate = Cate::select('id', 'name', 'parent_id')->get()->toArray();
        $data = Product::find($id)->toArray();
        return view('admin.product.edit', compact('data', 'cate'));
    }

    public function postEdit(CateRequest $request, $id)
    {
        $cate              = Cate::find($id);
        $cate->name        = $request->txtCateName;
        $cate->alias       = $request->txtCateName;
        $cate->order       = $request->txtOrder;
        $cate->parent_id   = $request->slcParent;
        $cate->keywords    = $request->txtKeywords;
        $cate->description = trim($request->txtDescription);
        $cate->save();
        return redirect()->route('admin.cate.list')->with(['level' => 'success', 'message' => 'Update success']);
    }

}
