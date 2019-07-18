@extends('layouts.app')

@section('content')
    @include('partial.sidebar')
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
    <div class="container" style="margin-right: 20px">
        <div class="row">
            <h1>Quản lý sách</h1>
            <div class="table table-responsive">
                <table class="table table-striped table-bordered" id="table">
                    <tr>
                        <th style="text-align: center">STT</th>
                        <th style="text-align: center">Tên sach</th>
                        <th style="text-align: center">Tên tác giả</th>
                        <th style="text-align: center">Trạng thái</th>
                        <th class="text-center" width="150px">
                            Hành động
                        </th>
                    </tr>
                    {{ csrf_field() }}
                    @foreach ($books as $key => $book)
                        <tr class="post{{$book->id}}">
                            <td style="text-align: center">{{$key + ONE + ($page - ONE) * PAGE_SIZE }}</td>
                            <td class="name" style="text-align: center">{{ $book->name }}</td>
                            <td class="author_id" style="text-align: center">{{ $book->author['name'] }}</td>
                            <td class="author_id" style="text-align: center">
                                @if($book->status == ZERO)
                                    Chưa mượn
                                @elseif($book->status == ONE)
                                    Đã mượn
                                @elseif($book->status == TWO)
                                    Đang xem
                                @endif
                            </td>
                            <td style="text-align: center">
                                <a href="{{route('borrow.show', $book->id)}}" class=" btn btn-info btn-sm">
                                    Xem chi tiết
                                </a>

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
    <script type="text/javascript">
        {{--$(document).ready(function () {--}}
        {{--    $.ajaxSetup({--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--        }--}}
        {{--    });--}}
        {{--    const EDIT_URL = "{{route('admin.book.edit')}}";--}}
        {{--    var id;--}}
        {{--    $('.edit-modal').on('click', function () {--}}
        {{--        id = $(this).data('id');--}}
        {{--        var tr = $(this).parents('tr');--}}
        {{--        var tdName = tr.find('.name');--}}
        {{--        var tdNameVal = tdName.text();--}}
        {{--        var input = '<input type="text" name="name" value="' + tdNameVal + '">';--}}
        {{--        tdName.html(input);--}}
        {{--        $(document).on('focusout', 'input[name="name"]', function () {--}}
        {{--            var input2 = $(this).val();--}}
        {{--            $.ajax({--}}
        {{--                url: EDIT_URL,--}}
        {{--                type: "POST",--}}
        {{--                data: {--}}
        {{--                    id: id, name: input2,--}}
        {{--                },--}}
        {{--                success: function (data) {--}}
        {{--                    tdName.html(input2);--}}
        {{--                }--}}
        {{--            });--}}
        {{--        });--}}
        {{--    });--}}
        {{--});--}}
    </script>
    @include('partial.footer')
@endsection