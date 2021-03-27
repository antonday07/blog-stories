@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-12 text-right">
                <a href="{{route('posts.index')}}" class="btn btn-outline-primary">
                    All blog
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9 mx-auto">

                @if(session('notification'))
                    <div class="alert alert-success">
                        {{ session('notification') }}
                    </div>
                @endif

                <div class="post">
                        <div class="single-post">
                            <h2>
                                <a href="#">{{$post->title}}</a>
                            </h2>
                            <p><span>Posted: </span>{{$post->updated_at->diffForHumans()}} </p>
                            <p><span>Category: </span>{{implode(", ", $categories)}}</p>
                            <p>
                                @foreach($post->tagsList() as $title)
                                    <span class="tag-template">
                                        {{$title}}
                                    </span>
                                @endforeach

                            </p>
                            <p>{!! nl2br($post->content) !!}</p>

                        </div>
                </div>

            </div>
        </div>
    </div>
@endsection
