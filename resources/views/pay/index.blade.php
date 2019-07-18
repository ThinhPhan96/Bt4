@extends('layouts.app')

@section('content')
    @include('partial.sidebar')
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
            <h1>Trả sách</h1>
            <div class="table table-responsive">
                <table class="table table-striped table-bordered" id="table">
                    <tr>
                        <th style="text-align: center">Sách</th>
                        <th style="text-align: center">Tác giả</th>
                        <th class="text-center" width="150px">
                            Hành động
                        </th>
                    </tr>
                    {{ csrf_field() }}
                    @foreach($book->books as $value)
                        <tr class="post{{$value->id}}">
                            <td class="name" style="text-align: center">{{ $value->name }}</td>
                            <td class="name" style="text-align: center">{{ $value->author->name }}</td>
                            <td style="text-align: center">
                                <form action="{{ route('pay.destroy', $value->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input onclick="return confirm('Bạn muốn trả sách này ?');" type="submit"
                                           class="btn btn-info" value="Trả sách" name="delete"/>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @include('partial.footer')
@endsection