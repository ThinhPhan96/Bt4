@extends('layouts.app')

@section('content')
    @include('partial.sidebar')
    <div class="container" style="margin-right: 20px">
        <div class="row">
            <div class="col-md-12">
                <h1>Xem sách</h1>
            </div>
        </div>
        <div class="name">
            Tên sach : {{$book->name }}
        </div>
        <br>
        <div class="author_name">
            Tên Tac giả : {{$book->author['name'] }}
        </div>
        <br>
        <div class="author_name">
            Trạng thái :
            @if($book->status == 0)
                Chưa mượn
            @elseif($book->status == 1)
                Đã mượn
            @elseif($book->status == 2)
                Đang xem
            @endif
        </div>
        <br>
        <div>
            <a href="{{route('borrow.edit', $book->id)}}" class="btn btn-info">Mượn sách</a>
        </div>
    </div>

    @include('partial.footer')
@endsection