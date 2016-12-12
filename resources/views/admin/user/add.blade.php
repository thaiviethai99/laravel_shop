@extends('admin.master')
@section('page-header')
<h1 class="page-header">User Add
</h1>
@endsection
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">
    <form action="{!!route('admin.user.postAdd')!!}" method="POST">
    {{ csrf_field() }}
        <div class="form-group">
            <label>Username</label>
            <input class="form-control" name="txtUserName" placeholder="Please Enter Username" value="{{ old('txtUserName')}}" />
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="txtPass" placeholder="Please Enter Password" />
        </div>
        <div class="form-group">
            <label>RePassword</label>
            <input type="password" class="form-control" name="txtPass_confirmation" placeholder="Please Enter RePassword" />
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="txtEmail" placeholder="Please Enter Email" value="{{ old('txtEmail')}}"/>
        </div>
        <div class="form-group">
            <label>User Level</label>
            <label class="radio-inline">
                <input name="rdoLevel" value="1" checked="checked" type="radio" {{ (old('rdoLevel')=="1") ? 'checked="checked"' : '' }}>Admin
            </label>
            <label class="radio-inline">
                <input name="rdoLevel" value="2" type="radio" {{ (old('rdoLevel')=="2") ? 'checked="checked"' : '' }} >Member
            </label>
        </div>
         <div class="form-group">
            <label>Status</label>
            <label class="radio-inline">
                <input name="rdoStatus" value="1" checked="checked" type="radio" radio" 
                {{ (old('rdoStatus')=="1") ? 'checked="checked"' : '' }}>Active
            </label>
            <label class="radio-inline">
                 <input name="rdoStatus" value="0" type="radio" {{ (old('rdoStatus')=="0") ? 'checked="checked"' : '' }} >Deactive
            </label>
        </div>
        <button type="submit" class="btn btn-default">User Add</button>
        <button type="submit" class="btn btn-default" onclick="window.location='{{route('admin.user.list')}}';return false;">Cancel</button>
    <form>
</div>
@endsection