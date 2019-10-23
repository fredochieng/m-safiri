@extends('adminlte::page')

@section('title', 'Users | M-Safiri Turyde')

@section('content_header')
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Users List</h3>
        <div class="pull-right">

        </div>
    </div>


    <div class="box-body">
        <div class="table-responsive">
            <table id="records" class="table table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Join Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                    <tr>
                        <td>{{$item->photo}}</td>
                        <td>{{$item->full_name}}</td>
                        <td>{{$item->user_email}}</td>
                        <td>{{$item->mobile_number}}</td>
                        <td>{{$item->gender}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->status}}</td>
                        <td>
                                <a href="/users/user/&id={{$item->user_id}}" class="btn btn-flat btn-info btn-sm"><i
                                    class="fa fa-eye"></i>
                                </a>

                              <a class="btn btn-danger btn-sm" title="Delete Route" href="#" data-toggle="modal"
                                    data-target="#modal_delete_route_{{$item->user_id}}" data-backdrop="static"
                                    data-keyboard="false"><i class="fa fa-trash"></i>
                              </a>

                        </td>
                    </tr>
                    @include('users.modals.modal_delete_user')
                    @include('users.modals.modal_user_details')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>

@stop
@section('css')
<link rel="stylesheet" href="/css/custom.css">
@stop
@section('js')
<script src="/js/dataTable.js"></script>
@stop
