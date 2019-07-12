@extends('admin.layouts.app')

@section('content')
    @include('admin.partial.sidebar')
    <div class="container" style="margin-right: 20px">
        <div class="row">
            <div class="col-md-12">
                <h1>Thùng rác</h1>
            </div>
        </div>
        <div class="row">
            <div class="form-three widget-shadow">
                @if (session('message'))
                    <div style="float: right" class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session('error'))
                    <div style="float: right" class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
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
                            <th style="text-align: center">Sach</th>
                            <th style="text-align: center">Tên tac gia</th>
                            <th class="text-center" width="150px">
                                Hành động
                            </th>
                        </tr>
                        {{ csrf_field() }}
                        <?php  $no = 1; ?>
                        @foreach ($books as $key => $book)
                            <tr class="post{{$book->id}}">
                                <td style="text-align: center">{{$key + 1 + ($page - 1) * PAGE_SIZE }}</td>
                                <td class="name" style="text-align: center">{{ $book->name }}</td>
                                <td class="name" style="text-align: center">
                                    {{   isset($book->author->name)? $book->author->name :'chua co tac gia'}}
                                </td>
                                <td style="text-align: center">
                                    <form action="{{ route('admin.trashbook.restore', $book->id) }}" method="POST">
                                        @csrf
                                        <input onclick="return confirm('Bạn muốn khôi phục sách này?');" type="submit"
                                               class="btn btn-info" value="Khôi phục" name="restore"/>
                                    </form>
                                    <form action="{{ route('admin.trashbook.forcedelete', $book->id) }}" method="POST">
                                        @csrf
                                        <input onclick="return confirm('Bạn muốn xóa hẳn sách này?');" type="submit"
                                               class="btn btn-danger" value="Xóa" name="delete"/>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div style="margin-left: 900px">
                    {{$books->links()}}
                </div>
            </div>
        </div>
    </div>
    {{--    <script type="text/javascript">--}}
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
    @include('admin.partial.footer')
@endsection