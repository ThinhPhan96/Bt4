@extends('admin.layouts.app')

@section('content')
    @include('admin.partial.sidebar')
    <div class="container" style="margin-right: 20px">
        <div class="row">
            <h1>Quản lý sách</h1>
        </div>
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
                    <a data-toggle="modal" data-target="#create" href="#"
                       class="create-modal btn btn-success">
                        Tạo mới sách
                    </a>
                    <ul class="nav nav-tabs  float-right" id="myDIV">
                        <li class="nav-item">
                            <a class="nav-link  {{ (\Request::route()->getName() == 'book.index') ? 'active' : '' }} "
                               href="{{ route('book.index') }}">Tất cả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ strpos(\Request::url(), 'book/0') ? 'active' : '' }} "
                               href="{{ route('book.show',ZERO) }}">Chưa mượn</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ strpos(\Request::url(), 'book/2') ? 'active' : '' }}"
                               href="{{ route('book.show',TWO) }}">Đang xem</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ strpos(\Request::url(), 'book/1') ? 'active' : '' }}"
                               href="{{ route('book.show',ONE) }}">Đã mượn</a>
                        </li>
                    </ul>
                    <tr>
                        <th style="text-align: center">STT</th>
                        <th style="text-align: center">Tên sach</th>
                        <th style="text-align: center">Tác giả</th>
                        <th style="text-align: center">Trạng thái</th>
                        <th style="text-align: center">Người mượn</th>
                        <th class="text-center" width="150px">
                            Hành động
                        </th>
                    </tr>
                    {{ csrf_field() }}
                    @foreach ($books as $key => $book)
                        <tr class="post{{$book->id}}">
                            <td style="text-align: center">{{$key + ONE + ($page - ONE) * PAGE_SIZE }}</td>
                            <td class="name" style="text-align: center">{{ $book->name }}</td>
                            <td class="author_id" style="text-align: center">{{ $book->author->name }}</td>
                            <td class="status" style="text-align: center">
                                @if($book->status == ZERO)
                                    Chưa mượn
                                @elseif($book->status == ONE)
                                    Đã mượn
                                @elseif($book->status == TWO)
                                    Đang xem
                                @endif
                            </td>
                            <td class="user" style="text-align: center">
                                @foreach($book->user as $user)
                                    {{ $user->name }}
                                @endforeach
                            </td>
                            <td style="text-align: center">
                                <button class=" edit-modal btn btn-warning" data-id="{{$book->id}}"
                                        data-name="{{$book->name}}">
                                    Sửa
                                </button>
                                <form style="float: right" action="{{ route('book.destroy', $book->id) }}"
                                      method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input onclick="return confirm('Bạn muốn xóa quyển sách này?');" type="submit"
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

        <!-- Modal add -->
        <div class="modal fade" id="create" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm mới sách</h4>
                    </div>
                    <div class="modal-body">
                        <form data-url="{{route('book.store')}}" class="form-horizontal" id="form_add"
                              method="post">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="name">Book:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="name" class="form-control" name="name"
                                           placeholder="Tên book">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="author_id">Author:</label>
                                <div class="col-sm-10">
                                    <select name="author_id" class="browser-default custom-select">
                                        @foreach($authors as $author)
                                            <option value="{{ $author->id }}"> {{ $author->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button style="margin-left: 350px" id="submit" type="submit" class="btn btn-info">Thêm
                            </button>
                            <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">
                                Hủy
                            </button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#submit').on('click', function (e) {
                e.preventDefault();
                var input3 = $("input[name='name']").val();
                var input4 = $("select[name='author_id']").val();
                $.ajax({
                    url: "{{route('book.store')}}",
                    type: "POST",
                    data: {
                        name: input3,
                        author_id: input4,
                    },
                    success: (book) => {
                        if (!book) {
                            return;
                        }
                        let {name, author_id, id} = book;
                        $.notify('Thêm sách thành công','success');
                        $('.btn-default').trigger('click');
                        $("tbody").append(`
                        <tr class="post${id}"><td style="text-align: center;">new</td> <td class="name" style="text-align: center;">${name}</td> <td class="author_id" style="text-align: center;">${author_id}</td> <td class="status" style="text-align: center;">
                                                                    Chưa mượn
                                                            </td> <td class="user" style="text-align: center;">

                                                            </td> <td style="text-align: center;"><button data-id="${id}" data-name="${author_id}" class=" edit-modal btn btn-warning">
                                    Sửa
                                </button> <form action="http://work.local/admin/book/${id}" method="POST" style="float: right;"><input type="hidden" name="_method" value="DELETE"> <input type="hidden" name="_token" value="UErwZ1nZndNKbdzwThUXXgZorZHytA06xQodnRri"> <input onclick="return confirm('Bạn muốn xóa quyển sách này?');" type="submit" value="Xóa" name="delete" class="btn btn-danger"></form></td></tr>
                        `)
                    },
                    error: (data) => {
                        $.notify('Tên không được trùng','error')
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const EDIT_URL = "{{route('admin.book.edit')}}";
            var id;
            $('.edit-modal').on('click', function () {
                id = $(this).data('id');
                var tr = $(this).parents('tr');
                var tdName = tr.find('.name');
                var tdNameVal = tdName.text();
                var input = '<input type="text" name="name" value="' + tdNameVal + '">';
                tdName.html(input);
                $(document).on('focusout', 'input[name="name"]', function () {
                    var input2 = $(this).val();
                    $.ajax({
                        url: EDIT_URL,
                        type: "POST",
                        data: {
                            id: id, name: input2,
                        },
                        success: function (data) {
                            tdName.html(input2);
                            $.notify('Sửa sách thành công','success')
                        },
                        error: () => {
                            $.notify('Sửa thất bại','error');
                        },

                    });
                });
            });
            $
        });
    </script>
    @include('admin.partial.footer')
@endsection