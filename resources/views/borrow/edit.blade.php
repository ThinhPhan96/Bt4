@extends('layouts.app')

@section('content')
    @include('partial.sidebar')
    @if($book->status == ONE)
        <div style="float:right" class="alert alert-danger">Sách hiện đã có người mượn</div>
    @else
        <div class="container" style="margin-right: 20px">
            <div class="row">
                <div class="col-md-12">
                    <h1>Mượn sách</h1>
                </div>
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
            </div>
            <div style="margin-left: 16px" class="name">
                Tên sach : <b>{{$book->name }}</b>
            </div>
            <br>
            <div style="margin-left: 16px" class="author_name">
                Tên Tac giả : <b>{{$book->author['name'] }}</b>
            </div>
            <br>
            <form class="form-horizontal" method="post" action="{{route('borrow.update', $book->id)}}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="control-label col-sm-2" for="pay">Ngày trả:</label>
                    <div class="col-sm-10">
                        <input style="width: 30%" type="date" name="pay" class="form-control" id="pay">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button style="margin-left: 300px" type="submit" class="btn btn-info">Mượn</button>
                    </div>
                </div>
            </form>
        </div>
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
    @endif
    @include('partial.footer')
@endsection