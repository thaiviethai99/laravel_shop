@extends('admin.master')
@section('page-header')
<h1 class="page-header">Product List
</h1>
@endsection
@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<thead>
    <tr align="center">
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Cate</th>
        <th>Status</th>
        <th>Delete</th>
        <th>Edit</th>
    </tr>
</thead>
<tbody>
    @php($stt=1)
    @foreach($data as $v)
    <tr class="odd gradeX" align="center">
        <td>{{$stt++}}</td>
        <td>{{$v['name']}}</td>
        <td>{{Helper::product_price($v['price'])}}</td>
        <td><?php
            $cate = App\Cate::find($v['cate_id']);
           echo $cate->name;
        ?></td>
        <td>{{($v['status']==1?('hiện'):'ẩn')}}</td>
        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="javascript:void(0)" onclick="delete2('{!! URL::route('admin.product.getDelete',$v['id']) !!}')">Delete</a></td>
        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.product.getEdit',$v['id']) !!}">Edit</a></td>
    </tr>
    @endforeach
</tbody>
</table>
@endsection
