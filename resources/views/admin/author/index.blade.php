@extends('admin.layouts.app')

@section('content')
    @include('admin.partial.sidebar')
    <div class="container" style="margin-right: 20px">
        <div class="row">
            <h1>Quản lý tác giả</h1>
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
                        <thead>
                        <a style="margin-bottom: 13px" data-toggle="modal" data-target="#create" href="#"
                           class="create-modal btn btn-success">
                            Thêm tác giả
                        </a>
                        <tr>
                            <th style="text-align: center">STT</th>
                            <th style="text-align: center">Tác giả</th>
                            <th class="text-center" width="150px">
                                Hành động
                            </th>
                        </tr>
                        {{ csrf_field() }}
                        </thead>
                        <tbody>
                        @foreach ($users as $key => $user)
                            <tr class="post{{$user->id}}">
                                <td style="text-align: center">{{$key + ONE + ($page - ONE) * PAGE_SIZE }}</td>
                                <td class="name" style="text-align: center">{{ $user->name }}</td>
                                <td style="text-align: center">
                                    <button class=" edit-modal btn btn-warning" data-id="{{$user->id}}"
                                            data-name="{{$user->name}}">
                                        Sửa
                                    </button>
                                    <form style="float: right" action="{{ route('author.destroy', $user->id) }}"
                                          method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <input onclick="return confirm('Bạn muốn xóa tác giả này ?');" type="submit"
                                               class="btn btn-danger" value="Xóa" name="delete"/>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="margin-left: 900px">
                    {{$users->links()}}
                </div>
            </div>

            <!-- Modal add -->
            <div class="modal fade" id="create" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Thêm mới tác giả</h4>
                            @if ($errors->any())
                                <div style="float: right" class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="modal-body">
                            <form data-url="{{route('author.store')}}" class="form-horizontal" id="form_add"
                                  method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="name">Author:</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="name" required class="form-control" name="name"
                                               placeholder="Tên tác giả">
                                    </div>
                                </div>
                                <button style="margin-left: 340px" id="submit" type="button" class="btn btn-info">Thêm
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
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const EDIT_URL = "{{route('admin.author.ajax')}}";
            var id;
            $('#submit').on('click', function (e) {
                e.preventDefault();
                var input3 = $("input[name='name']").val();
                $.ajax({
                    url: "{{route('author.store')}}",
                    type: "POST",
                    data: {
                        name: input3,
                    },
                    success: (author) => {
                        if (!author) {
                            return;
                        }
                        let {name, id} = author;
                        $.notify('Thêm sách thành công', 'success');
                        $('.btn-default').trigger('click');
                        $("tbody").append(`
                            <tr class="post${id}"><td style="text-align: center;">new</td> <td class="name" style="text-align: center;">${name}</td> <td style="text-align: center;"><button data-id="${id}" data-name="Ngay hom mai" class=" edit-modal btn btn-warning">
                                        Sửa
                                    </button> <form action="http://work.local/admin/author/${id}" method="POST" style="float: right;"><input type="hidden" name="_method" value="DELETE"> <input type="hidden" name="_token" value="UErwZ1nZndNKbdzwThUXXgZorZHytA06xQodnRri"> <input onclick="return confirm('Bạn muốn xóa tác giả này ?');" type="submit" value="Xóa" name="delete" class="btn btn-danger"></form></td></tr>
                        `);

                        $('.close').trigger('click');
                    },
                    error: (data) => {
                        $.notify('Thêm thất bại', 'error');
                    }
                });
            });
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
                            $.notify('Sửa tác giả thành công', 'success');
                        },
                        error: () => {
                            $.notify('Sửa thất bại', 'error');
                        },

                    });
                });
            });
            $("#form_add").validate({
                rules: {
                    name: "required",
                },
                messages: {
                    name: "Vui lòng nhập tên",
                }
            });
        });
    </script>
    @include('admin.partial.footer')
@endsection