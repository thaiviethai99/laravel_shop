@extends('admin.master')
@section('page-header')
<h1 class="page-header">User Add
</h1>
@endsection
@section('content')
<div class="col-lg-12" style="padding-bottom:120px">
<form action="{{route('admin.product.postAdd')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Category Parent</label>
            <select class="form-control" name="slcParent">
               {!! Helper::cate_parent($parent) !!}
            </select>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="txtName" placeholder="Please Enter Username" />
        </div>
        <div class="form-group">
            <label>Price</label>
            <input class="form-control" name="txtPrice" placeholder="Please Enter price" />
        </div>
        <div class="form-group">
            <label>Intro</label>
            <textarea class="form-control" rows="3" name="txtIntro" id="txtIntro"></textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                //var message = CKEDITOR.instances.messageArea.getData();
               CKEDITOR.replace( 'txtIntro', {
                height: '300px',
                enterMode: CKEDITOR.ENTER_BR, 
                toolbar:    
                    [
                        [,'Preview','Templates'],
                                   ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
                                   ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                   '/',
                                   ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                   ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
                                   ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                   ['BidiLtr', 'BidiRtl' ],
                                   ['Link','Unlink','Anchor'],
                                   ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
                                   '/',
                                   ['Styles','Format','Font','FontSize'],
                                   ['TextColor','BGColor'],
                                   ['Maximize','ShowBlocks','Syntaxhighlight']
                 ],
                 //filebrowserWindowWidth  : 300,
                 //filebrowserWindowHeight : 300,
                 filebrowserBrowseUrl : 'http://localhost/shop/public/admin/ckfinder/ckfinder.html',
 
                 filebrowserImageBrowseUrl : 'http://localhost/shop/public/admin/ckfinder/ckfinder.html?type=Images'
             });

            </script>
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control" rows="3" name="txtContent" id="txtContent"></textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                //var message = CKEDITOR.instances.messageArea.getData();
               CKEDITOR.replace( 'txtContent', {
                height: '300px',
                enterMode: CKEDITOR.ENTER_BR, 
                toolbar:    
                    [
                        [,'Preview','Templates'],
                                   ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
                                   ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                   '/',
                                   ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                   ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
                                   ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                   ['BidiLtr', 'BidiRtl' ],
                                   ['Link','Unlink','Anchor'],
                                   ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
                                   '/',
                                   ['Styles','Format','Font','FontSize'],
                                   ['TextColor','BGColor'],
                                   ['Maximize','ShowBlocks','Syntaxhighlight']
                 ],
                 //filebrowserWindowWidth  : 300,
                 //filebrowserWindowHeight : 300,
                 filebrowserBrowseUrl : 'http://localhost/shop/public/admin/ckfinder/ckfinder.html',
 
                 filebrowserImageBrowseUrl : 'http://localhost/shop/public/admin/ckfinder/ckfinder.html?type=Images'
             });

            </script>
        </div>
        <div class="form-group">
            <label>Hinh dai dien</label>
            <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
                <div>
                    <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                    <input type="file" name="avatar"/></span>
                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Product Keywords</label>
            <input class="form-control" name="txtOrder" placeholder="Please Enter Category Keywords" />
        </div>
        <div class="form-group">
            <label>Product Description</label>
            <textarea class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Product Status</label>
            <label class="radio-inline">
                <input name="rdoStatus" value="1" checked="" type="radio">Visible
            </label>
            <label class="radio-inline">
                <input name="rdoStatus" value="2" type="radio">Invisible
            </label>
        </div>
        <button type="submit" class="btn btn-default">Product Add</button>
        <button type="reset" class="btn btn-default">Reset</button>
    <form>
</div>
@endsection
