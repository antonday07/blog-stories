@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-right">
                <a href="{{route('posts.create')}}" class="btn btn-outline-primary">
                    New post
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 mx-auto">

                @if(session('notification'))
                    <div class="alert alert-success">
                        {{ session('notification') }}
                    </div>
                @endif

                <div class="post-wrapper">
                    @foreach($posts as $post)
                        <article class="single-post" onclick="window.location='{{route('posts.show', [$post->slug])}}'">
                            <h2>
                                {{ $post->title }}
                            </h2>
                            <p><span>{{ $post->user->name }}: </span>{{$post->updated_at->diffForHumans()}} </p>
                            <p><span>Category: </span>{{implode(", ", $post->categoriesList())}}</p>
                            <p>
                                @foreach($post->tagsList() as $title)
                                    <span class="tag-template">
                                        {{$title}}
                                    </span>
                                @endforeach

                            </p>
                            <p class="summary">{{$post->summary}}</p>

                            @can('update', $post)
                                <div class="post-button">
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-success flex-grow-1">Edit</a>
                                    <form method="post" action="{{ route('posts.destroy', [$post->slug]) }}" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure to delete this post ?')" type="submit" class="btn btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            @endcan

                        </article>
                    @endforeach
                </div>

                {{ $posts->links() }}
            </div>
        </div>
    </div>


@endsection
