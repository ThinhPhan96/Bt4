@extends('layouts.app')

@section('content')
    @include('partial.sidebar')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            Chào mừng bạn đến với trang sách!
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.partial.footer')
@endsection
