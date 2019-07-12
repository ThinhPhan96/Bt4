@extends('admin.layouts.app')

@section('content')
    @include('admin.partial.sidebar')
    <div class="container" style="margin-right: 20px">
        <div class="row">
            <div class="col-md-12">
                <h1>Quản lý sách</h1>
            </div>
        </div>
        <div class="row">
            <div class="form-three widget-shadow">
                @if (session('message'))
                    <div style="float: right" class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div style="float: right" class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="table table-responsive">
                    <table class="table table-striped table-bordered" id="table">
                        <a data-toggle="modal" data-target="#create" href="#"
                           class="create-modal btn btn-success">
                            Thêm sách
                        </a>
                        <ul class="nav nav-tabs float-right">
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('book.index') }}">Tất cả</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('book.show',0) }}">Chưa mượn</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('book.show',2) }}">Đang xem</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('book.show',1) }}">Đã mượn</a>
                            </li>
                        </ul>
                        <tr>
                            <th style="text-align: center">STT</th>
                            <th style="text-align: center">Tên sach</th>
                            <th style="text-align: center">Tên tác giả</th>
                            <th style="text-align: center">Trạng thái</th>
                            <th style="text-align: center">Người mượn</th>
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
                                <td class="author_id" style="text-align: center">{{ $book->author->name }}</td>
                                <td class="status" style="text-align: center">
                                    @if($book->status == 0)
                                        Chưa mượn
                                    @elseif($book->status == 1)
                                        Đã mượn
                                    @elseif($book->status == 2)
                                        Đang xem
                                    @endif
                                </td>
                                <td class="user" style="text-align: center">
                                    @if($book->status == 0)
                                        Chưa có
                                    @endif
                                </td>
                                <td style="text-align: center">
                                    <button class=" edit-modal btn btn-warning" data-id="{{$book->id}}"
                                            data-name="{{$book->name}}">
                                        Sửa
                                    </button>
                                    <form action="{{ route('book.destroy', $book->id) }}" method="POST">
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
                                        <select name="author_id">
                                            @foreach($authors as $author)
                                                <option value="{{ $author->id }}"> {{ $author->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button id="submit" type="submit" class="btn btn-info">Add</button>
                                <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">
                                    Close
                                </button>
                            </form>
                        </div>

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
                        }
                    });
                });
            });
        });
    </script>
    @include('admin.partial.footer')
@endsection