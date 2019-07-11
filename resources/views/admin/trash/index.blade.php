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
                    <ul class="nav nav-tabs float-right">
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('trash.index')}}">Tác giả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('trashbook.index')}}">Sách</a>
                        </li>
                    </ul>
                    <tr>
                        <th style="text-align: center">STT</th>
                        <th style="text-align: center">Tên tác giả</th>
                        <th style="text-align: center">Tên sach</th>
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
                            <td class="name" style="text-align: center">
                                {{   isset($author->book['name'])? $author->book['name']:'chua co sach'}}
                            </td>
                            <td style="text-align: center">
                                <form action="{{ route('admin.trash.restore', $author->id) }}" method="POST">
                                    @csrf
                                    <input onclick="return confirm('Bạn muốn khôi phục tác giả này?');" type="submit" class="btn btn-info" value="Khôi phục" name="restore"/>
                                </form>
                                <form action="{{ route('admin.trash.forcedelete', $author->id) }}" method="POST">
                                    @csrf
                                    <input onclick="return confirm('Bạn muốn xóa hẳn tác giả này?');" type="submit" class="btn btn-danger" value="Xóa" name="delete"/>
                                </form>
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
    <script type="text/javascript">
        {{--$(document).ready(function () {--}}
        {{--    $.ajaxSetup({--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--        }--}}
        {{--    });--}}
        {{--    const RESTORE_URL = "{{route('admin.trash.restore')}}";--}}
        {{--    const DELETE_URL = "{{route('admin.trash.forcedelete')}}";--}}
        {{--    var id;--}}
        {{--    $('.restore-modal').on('click', function () {--}}
        {{--        id = $(this).data('id');--}}
        {{--        console.log(id);--}}
        {{--        $.ajax({--}}
        {{--            url: RESTORE_URL,--}}
        {{--            type: "POST",--}}
        {{--            data: {--}}
        {{--                id: id,--}}
        {{--            },--}}
        {{--            success: function (data) {--}}
        {{--                console.log(data);--}}
        {{--            }--}}
        {{--        });--}}
        {{--    });--}}
        {{--    $('.delete-modal').on('click', function () {--}}
        {{--        id = $(this).data('id');--}}
        {{--        console.log(id);--}}
        {{--        $.ajax({--}}
        {{--            url: DELETE_URL,--}}
        {{--            type: "POST",--}}
        {{--            data: {--}}
        {{--                id: id,--}}
        {{--            },--}}
        {{--            success: function (data) {--}}
        {{--                console.log(data);--}}
        {{--            }--}}
        {{--        });--}}
        {{--    });--}}
        {{--});--}}
    </script>
    @include('admin.partial.footer')
    @endsection