
                    <!-- /.col-lg-12 -->
@extends('admin.master')
@section('page-header')
<h1 class="page-header">User List
</h1>
@endsection
@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Level</th>
            <th>Status</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
    @php($count=1)
    @foreach($data as $v)
        <tr class="odd gradeX" align="center">
            <td>{{$count++}}</td>
            <td>{{$v['username']}}</td>
            <td>{{$v['email']}}</td>
            <td>
            @if($v['id']==1)
                Super Admin
            @elseif($v['level']==1)
                Admin
            @else
                Member
            @endif
            </td>
            <td>{{($v['status']==1)?'Active':'DeActive'}}</td>
            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="javascript:void(0)" onclick="delete2('{!! URL::route('admin.user.getDelete',$v['id']) !!}')"> Delete</a></td>
            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.user.getEdit',$v['id']) !!}">Edit</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
