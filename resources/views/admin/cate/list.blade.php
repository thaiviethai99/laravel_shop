@extends('admin.master')
@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Name</th>
            <th>Category Parent</th>
            <th>Status</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
    @php($stt=0)
    @forelse($data as $v)
        <tr class="odd gradeX" align="center">
            <td>{{$stt++}}</td>
            <td>{{$v['name']}}</td>
            <td>
                @if($v['parent_id']==0)
                {{ "None"}}
                @else
                <?php
                    $parent = DB::table('cates')->where('id',$v['parent_id'])->first();
                    echo $parent->name;
                ?>
                @endif
            </td>
            <td>Hiện</td>
            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{!! URL::route('admin.cate.getDelete',$v['id']) !!}"> Delete</a></td>
            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.cate.getEdit',$v['id']) !!}">Edit</a></td>
        </tr>
    @empty
    <tr>
        <td colspan="6">Chua co du lieu</td>
    </tr>
    @endforelse
    </tbody>
</table>
@endsection