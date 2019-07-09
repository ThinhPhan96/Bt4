@extends('admin.layouts.app')

@section('content')
    @include('admin.partial.sidebar')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Quản lý tác giả</h1>
            </div>
        </div>
        <div class="row">
            <div class="table table-responsive">
                <table class="table table-striped table-bordered" id="table">
                    <tr>
                        <th style="text-align: center">STT</th>
                        <th style="text-align: center">Tên tác giả</th>
                        <th class="text-center" width="150px">
                            <a data-toggle="modal" data-target="#create" href="#" class="create-modal btn btn-success btn-sm">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        </th>
                    </tr>
                    {{ csrf_field() }}
                    <?php  $no = 1; ?>
                    @foreach ($authors as $author)
                        <tr class="post{{$author->id}}">
                            <td style="text-align: center">{{ $no++ }}</td>
                            <td style="text-align: center">{{ $author->name }}</td>
                            <td style="text-align: center">
                                <a href="#" class="edit-modal btn btn-warning btn-sm" data-id="{{$author->id}}"
                                   data-name="{{$author->name}}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{$author->id}}"
                                   data-name="{{$author->name}}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            {{$authors->links()}}
        </div>

            <!-- Modal -->
            <div class="modal fade" id="create" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Thêm mới tác giả</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" action="" method="post">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="name">Author:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" placeholder="Tên tác giả">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="add" type="button" class="btn btn-primary">Lưu lại</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <script type="text/javascript">
        $("#add").click(function() {
            $.ajax({
                type: 'POST',
                url: '{{route('author.store')}}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'name': $('input[name=name]').val(),
                },
                success: function(data){
                    if ((data.errors)) {
                        $('.error').removeClass('hidden');
                        $('.error').text(data.errors.name);
                    } else {
                        $('.error').remove();
                        $('#table').append("<tr class='post" + data.id + "'>"+
                            "<td>" + data.id + "</td>"+
                            "<td>" + data.name + "</td>"+
                            "<td><button class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-title='" + data.name + "' data-body='" + data.body + "'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='glyphicon glyphicon-pencil'></span></button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='glyphicon glyphicon-trash'></span></button></td>"+
                            "</tr>");
                    }
                },
            });
            $('#name').val('');
        });
    </script>
    @include('admin.partial.footer')
@endsection