@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9 text-center">
                <a href="{{route('posts.index')}}" class="btn btn-outline-primary">
                    Blog Stories
                </a>
            </div>
        </div>
    </div>


@endsection
