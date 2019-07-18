@extends('layouts.app')

@section('content')
    @include('partial.sidebar')
    <div class="container" style="margin-right: 20px">
        <div class="row">
            <div class="col-md-12">
                <h1>Người dùng</h1>
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
                        <tr>
                            <th style="text-align: center">Tên user</th>
                            <th style="text-align: center">Email</th>
                            <th class="text-center" width="150px">
                                Hành động
                            </th>
                        </tr>
                        {{ csrf_field() }}
                        <tr class="post{{$user->id}}">
                            <td class="name" style="text-align: center">{{ $user->name }}</td>
                            <td style="text-align: center">{{ $user->email }}</td>
                            <td style="text-align: center">
                                <button class=" edit-modal btn btn-warning" data-id="{{$user->id}}"
                                        data-name="{{$user->name}}">
                                    Sửa
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="margin-left: 900px">
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
            const EDIT_URL = "{{route('user.root.edit')}}";
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
    @include('partial.footer')
@endsection