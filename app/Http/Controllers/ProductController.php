<?php

namespace App\Http\Controllers;

use App\Cate;
use App\Product;
use App\ProductImage;
use Auth;
use File;
use Illuminate\Http\Request;
use Image;
use Validator;

//use Request;
class ProductController extends Controller
{
    private function resize($image, $size)
    {
        try
        {
            $extension     = $image->getClientOriginalExtension();
            $imageRealPath = $image->getRealPath();
            $thumbName     = 'thumb_' . $image->getClientOriginalName();

            //$imageManager = new ImageManager(); // use this if you don't want facade style code
            //$img = $imageManager->make($imageRealPath);

            $img = Image::make($imageRealPath); // use this if you want facade style code
            $img->resize(intval($size), null, function ($constraint) {
                $constraint->aspectRatio();
            });
            return $img->save(public_path('images') . '/' . $thumbName);
        } catch (Exception $e) {
            return false;
        }
    }
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
            return redirect()->back()->withInput()->withErrors($v->errors());
        } else {
            $destinationPath = 'public/uploads/images'; // upload path
            $extension       = $request->avatar->getClientOriginalExtension(); // getting image extension
            $fileName        = time() . '.' . $extension; // renameing image
            $request->file('avatar')->move($destinationPath, $fileName);
            //resize image
            $thumbName     = 'thumb_' . $fileName;
            $imageRealPath = $destinationPath . '/' . $fileName;
            $img           = Image::make($imageRealPath);
            $img->resize(270, 350);
            $img->save($destinationPath . '/' . $thumbName);
            //thumb_small 40X40
            $smallThumbName     = 'small_thumb_' . $fileName;
            $img           = Image::make($imageRealPath);
            $img->resize(40, 40);
            $img->save($destinationPath . '/' . $smallThumbName);
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
                    $destinationPath          = 'public/uploads/details';
                    $extension                = $file->getClientOriginalExtension(); // getting image extension
                    $fileName                 = time() . '.' . $extension; // renameing image
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
        $productImages = Product::find($id)->images->toArray();
        foreach ($productImages as $image) {
            File::delete('public/uploads/details/' . $image['image']);
        }
        $product = Product::find($id);
        File::delete('public/uploads/images/' . $product->image);
        $product->delete($id);
        return redirect()->route('admin.product.list')->with(['level' => 'success', 'message' => 'Delete success']);
    }

    public function getEdit(Request $request, $id)
    {
        //echo Config::get('app.url');
        $cate            = Cate::select('id', 'name', 'parent_id')->get()->toArray();
        $product         = Product::find($id)->toArray();
        $product_images1 = Product::find($id)->images->toArray();
        $product_images  = array();
        foreach ($product_images1 as $product_image) {
            $image            = $product_image['image'];
            $thumb            = $product_image['image'];
            $chap_image_id    = $product_image['id'];
            $product_images[] = array(
                'image'         => $image,
                'thumb'         => $request->root() . '/public/uploads/details/' . $thumb,
                'chap_image_id' => $chap_image_id,
            );
        }
        $product_id = $id;
        return view('admin.product.edit', compact('product', 'cate', 'product_images', 'product_id'));
    }

    public function postEdit(Request $request, $id)
    {

        $v = Validator::make($request->all(), [
            'txtName'    => 'required',
            'txtPrice'   => 'required',
            'txtIntro'   => 'required',
            'txtContent' => 'required',
            'slcCate'    => 'required',
        ],
            [
                'txtName.required'    => 'Ten khong duoc bo trong',
                'txtPrice.required'   => 'Gia khong duoc bo trong',
                'txtIntro.required'   => 'Intro khong duoc bo trong',
                'txtContent.required' => 'Content khong duoc bo trong',
            ]);
        if ($v->fails()) {
            return redirect()->back()->withInput()->withErrors($v->errors());
        } else {
            $product          = Product::find($id);
            $product->name    = $request->txtName;
            $product->alias   = $request->txtAlias;
            $product->price   = $request->txtPrice;
            $product->intro   = $request->txtIntro;
            $product->content = $request->txtContent;
            //$product->image       = $fileName;
            $product->keywords    = $request->txtKeywords;
            $product->description = $request->txtDescription;
            $product->status      = $request->rdoStatus;
            $product->cate_id     = $request->slcCate;
            $product->user_id     = Auth::id();
            $save                 = $product->save();
            $updateId             = $id;

            if (!empty($request->file('avatar'))) {
                $destinationPath = 'public/uploads/images'; // upload path
                $extension       = $request->avatar->getClientOriginalExtension(); // getting image extension
                $fileName        = $product->image; // renameing image
                $request->file('avatar')->move($destinationPath, $fileName);
                $thumbName     = 'thumb_' . $fileName;
                $smallThumbName = 'small_thumb_'.$fileName;
                $imageRealPath = $destinationPath . '/' . $fileName;
                $img           = Image::make($imageRealPath);
                $img->resize(270, 350);
                $img->save($destinationPath . '/' . $thumbName);
                $img           = Image::make($imageRealPath);
                $img->resize(40, 40);
                $img->save($destinationPath . '/' . $smallThumbName);
            }
            // getting all of the post data
            if (!empty($request->file('images'))) {
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
                        $destinationPath          = 'public/uploads/details';
                        $extension                = $file->getClientOriginalExtension(); // getting image extension
                        $fileName                 = rand(11111, 99999) . '.' . $extension; // renameing image
                        $upload_success           = $file->move($destinationPath, $fileName);
                        $productImage             = new ProductImage();
                        $productImage->image      = $fileName;
                        $productImage->product_id = $updateId;
                        $productImage->save();
                        $uploadcount++;
                    }
                }
                if ($uploadcount == $file_count) {

                    return redirect()->route('admin.product.list')->with(['level' => 'success', 'message' => 'Add success']);
                } else {
                    return redirect()->back()->withInput()->withErrors($validator);
                }
            }
            return redirect()->route('admin.product.list')->with(['level' => 'success', 'message' => 'Add success']);
        }
    }

    public function getDelImg(Request $request, $id)
    {
        if ($request->ajax()) {
            $productImage = ProductImage::find($id);
            if (!empty($productImage)) {
                $img = 'public/uploads/details/' . $productImage->image;
                if (File::exists($img)) {
                    File::delete($img);
                }
                $productImage->delete();
            }
            return "ok";
        }
    }

    public function updateImage(Request $request)
    {
        $destinationPath = 'public/uploads/details'; // upload path
        $fileName        = $request->id_update; // renameing image
        $result          = $request->file('file')->move($destinationPath, $fileName);
        if (isset($result)) {
            echo '1';
        } else {
            echo '0';
        }

    }

    public function showfileupload(Request $request)
    {
        //       Route::post('/uploadfile', 'FileuploadingController@showfileupload');

        $file = $request->file('image');
        // show the file name
        echo 'File Name : ' . $file->getClientOriginalName();
        echo '<br>';

        // show file extensions
        echo 'File Extensions : ' . $file->getClientOriginalExtension();
        echo '<br>';

        // show file path
        echo 'File Path : ' . $file->getRealPath();
        echo '<br>';

        // show file size
        echo 'File Size : ' . $file->getSize();
        echo '<br>';

        // show file mime type
        echo 'File Mime Type : ' . $file->getMimeType();
        echo '<br>';

        // move uploaded File
        $destinationPath = 'uploads';
        $file->move($destinationPath, $file->getClientOriginalName());
    }

}
