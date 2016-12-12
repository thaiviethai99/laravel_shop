@extends('admin.master')
@section('content')
 <div class="col-lg-7" style="padding-bottom:120px">
    <form action="{!!route('admin.cate.postAdd')!!}" method="POST">
    {{ csrf_field() }}
        <div class="form-group">
            <label>Category Parent</label>
            <select class="form-control" name="slcParent">
            <option value="0">Please choose category</option>
               {!! Helper::cate_parent($parent) !!}
            </select>
        </div>
        <div class="form-group">
            <label>Category Name</label>
            <input class="form-control" name="txtCateName" placeholder="Please Enter Category Name" value="{{ old('txtCateName') }}" />
        </div>
        <div class="form-group">
            <label>Category Order</label>
            <input class="form-control" name="txtOrder" placeholder="Please Enter Category Order" value="{{ old('txtOrder') }}"/>
        </div>
        <div class="form-group">
            <label>Category Keywords</label>
            <input class="form-control" name="txtKeywords" placeholder="Please Enter Category Keywords" value="{{old('txtKeywords')}}" />
        </div>
        <div class="form-group">
            <label>Category Description</label>
            <textarea class="form-control" rows="3" name="txtDescription">{{ old('txtDescription') }}</textarea>
        </div>
        <div class="form-group">
            <label>Category Status</label>
            <label class="radio-inline">
                <input name="rdoStatus" value="1" checked="" type="radio">Visible
            </label>
            <label class="radio-inline">
                <input name="rdoStatus" value="2" type="radio">Invisible
            </label>
        </div>
        <button type="submit" class="btn btn-default">Category Add</button>
        <button type="reset" class="btn btn-default">Reset</button>
    <form>
</div>
@endsection()