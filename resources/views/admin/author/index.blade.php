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
                <h1>Quản lý tác giả</h1>
            </div>
        </div>
        <div class="row">
            <div class="table table-responsive">
                <table class="table table-striped table-bordered" id="table">
                    <a style="margin-bottom: 13px" data-toggle="modal" data-target="#create" href="#"
                       class="create-modal btn btn-success">
                        Thêm tác giả
                    </a>
                    <tr>
                        <th style="text-align: center">STT</th>
                        <th style="text-align: center">Tên tác giả</th>
                        <th class="text-center" width="150px">
                            Hành động
                        </th>
                    </tr>
                    {{ csrf_field() }}
                    <?php  $no = 1; ?>
                    @foreach ($users as $key => $user)
                        <tr class="post{{$user->id}}">
                            <td style="text-align: center">{{$key + 1 + ($page - 1) * PAGE_SIZE }}</td>
                            <td class="name" style="text-align: center">{{ $user->name }}</td>
                            <td style="text-align: center">
                                <button class=" edit-modal btn btn-warning" data-id="{{$user->id}}"
                                   data-name="{{$user->name}}">
                                    Sửa
                                </button>
{{--                                <a class="delete-modal btn btn-danger btn-sm" data-id="{{$user->id}}"--}}
{{--                                   data-name="{{$user->name}}">--}}
{{--                                    Xóa--}}
{{--                                </a>--}}
                                <form action="{{ route('author.destroy', $user->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input onclick="return confirm('Bạn muốn xóa tác giả này ?');" type="submit" class="btn btn-danger" value="Xóa" name="delete"/>
                                </form>

                            </td>
                        </tr>
                    @endforeach
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
                    </div>
                    <div class="modal-body">
                        <form data-url="{{route('author.store')}}" class="form-horizontal" id="form_add" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="name">Author:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="name" required class="form-control" name="name"
                                           placeholder="Tên tác giả">
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
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const EDIT_URL = "{{route('admin.author.ajax')}}";
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