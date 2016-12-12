@extends('admin.master')
@section('page-header')
<h1 class="page-header">User Add
</h1>
@endsection
@section('content')
<div class="col-lg-12" style="padding-left:20px;padding-right:20px">
<div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> User Add </h3>
      </div>
      <div class="panel-body">
       <form action="{!!route('admin.product.postEdit',$product['id'])!!}" method="POST" enctype="multipart/form-data">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-data" data-toggle="tab">Data</a></li>
             <li><a href="#tab-image" data-toggle="tab">Image </a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-data">
              
        {{ csrf_field() }}
        <div class="form-group">
           <label>Category Parent</label>
            <select class="form-control" name="slcCate" id="slcCate">
               {!! Helper::cate_parent($cate,0,"--",$product['cate_id']) !!}
            </select>
            <script>
              $(function(){
                //$('#slcParent').val({{$product['cate_id']}});
              })
            </script>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="txtName" id="txtName" placeholder="Please Enter Product Name" value="{{ old('txtName',$product['name']) }}" onkeyup="ChangeToSlug();" />
        </div>
        <div class="form-group">
            <label>Alias</label>
            <input class="form-control" name="txtAlias" id="txtAlias" placeholder="Please Enter Alias" value="{{ old('txtAlias',$product['alias']) }}" />
        </div>
        <div class="form-group">
            <label>Price</label>
            <input class="form-control" name="txtPrice" placeholder="Please Enter price" value="{{ old('txtPrice',$product['price']) }}" />
        </div>
        <div class="form-group">
            <label>Intro</label>
            <textarea class="form-control" rows="3" name="txtIntro" id="txtIntro">
              {{ old('txtIntro',$product['intro']) }}
            </textarea>
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
                 filebrowserBrowseUrl : '../../public/admin/ckfinder/ckfinder.html',
 
                 filebrowserImageBrowseUrl : '../../public/admin/ckfinder/ckfinder.html?type=Images'
             });

            </script>
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control" rows="3" name="txtContent" id="txtContent">
              {{ old('txtContent',$product['content']) }}
            </textarea>
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
                 filebrowserBrowseUrl : '../../public/admin/ckfinder/ckfinder.html',
 
                 filebrowserImageBrowseUrl : '../../public/admin/ckfinder/ckfinder.html?type=Images'
             });

            </script>
        </div>
        <div class="form-group">
            <label>Hinh dai dien</label>
            <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
                  <img src="{!!asset('public/uploads/images/'.$product['image'])!!}"/>
                </div>
                <div>
                    <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                    <input type="file" name="avatar"/></span>
                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Product Keywords</label>
            <input class="form-control" name="txtKeywords" placeholder="Please Enter Category Keywords" value="{{ old('txtKeywords',$product['keywords']) }}" />
        </div>
        <div class="form-group">
            <label>Product Description</label>
            <textarea class="form-control" rows="3" name="txtDescription">{{ old('txtDescription',$product['description']) }}</textarea>
        </div>
        <div class="form-group">
             <label>Status</label>
            <label class="radio-inline">
                {{ Form::radio('rdoStatus', '1', ($product['status'] == '1')) }} Active
            </label>
            <label class="radio-inline">
                {{ Form::radio('rdoStatus', '0', ($product['status'] == '0')) }} Deactive
            </label>
        </div>
        
            </div>
             <div class="tab-pane" id="tab-image">
              
              <div class="table-responsive">
                <table id="images" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                       <td>Thứ tự</td>
                      <td class="text-left">Additional Images</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $image_row = 0; ?>
                    <?php foreach ($product_images as $product_image) { ?>
                    <tr id="image-row<?php echo $image_row; ?>">
                    <td class="text-right"><?php echo $image_row;?></td>
                      <td class="text-left">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
                                  <img src="<?php echo $product_image['thumb']; ?>" alt="" title=""  />
                                </div>
                                <div>
                                    <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                    <input type="file" name="product_image[<?php echo $image_row; ?>][image]" id="input-image<?php echo  $image_row;  ?>"
                                    value=""
                                    /></span>
                                   
                                </div>
                            </div>
                      </td>
                      <td class="text-left">
                      <input type="hidden" name="product_image[<?php echo $image_row; ?>][image_update]" id="image_update<?php echo  $image_row;?>"  value="<?php echo $product_image['image'] ?>"/>
                      <input type="hidden" name="product_image[<?php echo $image_row; ?>][chap_image_id]" class="chap_image_id"  value="<?php echo $product_image['chap_image_id'] ?>"/>
                        <button type="button" onclick="uploadImage('#input-image<?php echo $image_row; ?>','#image_update<?php echo $image_row; ?>')" data-toggle="tooltip" title="" class="btn btn-primary upload">
                        <i class="fa fa-upload"></i>
                        </button>
                        <button type="button" onclick="deleteImage('#image-row<?php echo $image_row; ?>');" data-toggle="tooltip" title="" class="btn btn-danger">
                        <i class="fa fa-minus-circle"></i>
                        </button>
                      </td>
                    </tr>
                    <?php $image_row++; ?>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="2"></td>
                      <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <button type="submit" class="btn btn-default">Product Add</button>
        <button type="reset" class="btn btn-default">Reset</button>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection
<script type="text/javascript">
var image_row = <?php echo $image_row; ?>;

function addImage() {
  html  = '<tr id="image-row' + image_row + '">';
  html += '<td class="text-right">'+image_row + '</td>';
  html +='<td class="text-left"><div class="fileupload fileupload-new" data-provides="fileupload"><div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div><div><span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file"  name="images[]" value="" id="input-image' + image_row + '" /></span></div></div></td>';
 
  html += '  <td class="text-left insert"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';

  $('#images tbody').append(html);

  image_row++;
}

function uploadImage(id,id_update){
    //var formData = new FormData($('#form-information')[0]);
   var data = new FormData();
    data.append('file', $(id)[0].files[0]);
    data.append('id_update', $(id_update).val());
    data.append('_token',$('input[name=_token]').val());
  $.ajax({
    url: url +'/admin/product/updateImage',
    type: 'POST',
    data: data,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (data) {
      console.log(data);
    }
  });
 
  return false;
};
function deleteImage(id){
  var image_id = $(id).find('.chap_image_id').val();
  $.ajax({
    url: url+'/admin/product/delImg/'+image_id,
    type: 'GET',
    dateType:"text",
    data: {"_token": $('input[name=_token]').val()},
    success: function (data) {
      $(id).remove();
    }
  });
}
            function ChangeToSlug()
            {
                var title, slug;
 
                //Lấy text từ thẻ input title 
                title = $('#txtName').val();
 
                //Đổi chữ hoa thành chữ thường
                slug = title.toLowerCase();
 
                //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
                $('#txtAlias').val(slug);
              }
</script>
