@extends('admin.master')
@section('page-header')
<h1 class="page-header">User Update
</h1>
@endsection
@section('content')
<div class="col-lg-12">
    @if (session('error'))
        @foreach(session('error') as $err)
            <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ $err }}
            </div>
        @endforeach
    @endif
</div>
<div class="col-lg-7" style="padding-bottom:120px">
    <form action="{!!route('admin.user.postEdit',$data['id'])!!}" method="POST">
    {{ csrf_field() }}
        <div class="form-group">
            <label>Username</label>
            <input class="form-control" name="txtUserName" placeholder="Please Enter Username" value="{{old('txtUserName',$data['username'])}}"/>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="txtPass" placeholder="Please Enter Password" value="" />
        </div>
        <div class="form-group">
            <label>RePassword</label>
            <input type="password" class="form-control" name="txtPass_confirmation" placeholder="Please Enter RePassword" value=""/>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="txtEmail" placeholder="Please Enter Email" value="{{old('txtEmail',$data['email'])}}" />
        </div>
        @if(Auth::id()!=$id)
        <div class="form-group">
            <label>User Level</label>
            <label class="radio-inline">
                {{ Form::radio('rdoLevel', '1', ($data['level'] == '1')) }} Admin
            </label>
            <label class="radio-inline">
                {{ Form::radio('rdoLevel', '2', ($data['level'] == '2')) }} Member
            </label>
        </div>
        <div class="form-group">
            <label>Status</label>
            <label class="radio-inline">
                {{ Form::radio('rdoStatus', '1', ($data['status'] == '1')) }} Active
            </label>
            <label class="radio-inline">
                {{ Form::radio('rdoStatus', '0', ($data['status'] == '0')) }} Deactive
            </label>
        </div>
        @endif
        <button type="submit" class="btn btn-default">User Update</button>
        <button type="submit" class="btn btn-default" onclick="window.location='{{route('admin.user.list')}}';return false;">Cancel</button>
    <form>
</div>
@endsection