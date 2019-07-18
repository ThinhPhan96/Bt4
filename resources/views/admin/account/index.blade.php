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
            <h1>Quản lý người dùng</h1>
            <div class="table table-responsive">
                <table class="table table-striped table-bordered" id="table">
                    <tr>
                        <th style="text-align: center">Email</th>
                        <th style="text-align: center">Tên quản lý</th>
                        <th class="text-center" width="150px">
                            Hành động
                        </th>
                    </tr>
                    {{ csrf_field() }}
                    @foreach ($admin as $key => $root)
                        <tr class="post{{$root->id}}">
                            <td style="text-align: center">{{ $root->email }}</td>
                            <td class="name" style="text-align: center">{{ $root->name }}</td>
                            <td style="text-align: center">
                                <a class=" edit-modal btn btn-warning" data-id="{{$root->id}}"
                                   data-name="{{$root->name}}">
                                    Sửa
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
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
            const EDIT_URL = "{{route('admin.root.edit')}}";
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
                        success: function () {
                            tdName.html(input2);
                            $.notify('Sửa thành công','success');
                        },
                        error: () => {
                            $.notify('Sửa thất bại','error');
                        },

                    });
                });
            });
        });
    </script>
    @include('admin.partial.footer')
@endsection