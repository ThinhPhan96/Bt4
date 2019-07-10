@extends('admin.layouts.app')

@section('content')
    @include('admin.partial.sidebar')
    @if (session('message'))
        <div style="float: right" class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container" style="margin-right: 20px">
        <div class="row">
            <div class="col-md-12">
                <h1>Thùng rác</h1>
            </div>
        </div>
        <div class="row">
            <div class="table table-responsive">
                <table class="table table-striped table-bordered" id="table">
                    <tr>
                        <th style="text-align: center">STT</th>
                        <th style="text-align: center">Tên tác giả</th>
                        <th class="text-center" width="150px">
                            Hành động
                        </th>
                    </tr>
                    {{ csrf_field() }}
                    <?php  $no = 1; ?>
                    @foreach ($authors as $key => $author)
                        <tr class="post{{$author->id}}">
                            <td style="text-align: center">{{$key + 1 + ($page - 1) * PAGE_SIZE }}</td>
                            <td class="name" style="text-align: center">{{ $author->name }}</td>
                            <td style="text-align: center">
                                <a class=" edit-modal btn btn-info btn-sm" data-id="{{$author->id}}"
                                   data-name="{{$author->name}}">
                                    Khôi phục
                                </a>
                                <a class="delete-modal btn btn-danger btn-sm" data-id="{{$author->id}}"
                                   data-name="{{$author->name}}">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div style="margin-left: 900px">
                {{$authors->links()}}
            </div>
        </div>
    </div>
    @endsection