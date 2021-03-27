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
                <h2 class="h2">Create new Post</h2>
                <form method="post" action="{{ route('posts.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{old('title')}}">

                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="summary" class="font-weight-bold">Summary</label>
                        <textarea class="form-control @error('summary') is-invalid @enderror" name="summary" id="summary" cols="30" rows="3">{{old('summary')}}</textarea>

                        @error('summary')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content" class="font-weight-bold">Content</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" cols="30" rows="10">{{old('content')}}</textarea>

                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <h6 class="font-weight-bold">Category</h6>

                        <select class="js-choose-category-multiple @error('categories') is-invalid @enderror" name="categories[]" multiple="multiple">
                            @foreach($categories as $key => $category)
                                <option value="{{$category->title}}:{{$category->id}}">{{ $category->title}}</option>
                            @endforeach
                        </select>


                        @error('categories')
                                <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <h6 class="font-weight-bold">Tag</h6>

                        <select class="js-choose-tag-multiple @error('tags') is-invalid @enderror" name="tags[]" multiple="multiple">
                            @foreach($tags as $key => $tag)
                                <option value="{{$tag->title}}:{{ $tag->id }}">{{ $tag->title }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                             <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".js-choose-category-multiple").select2({
                placeholder: 'Select category',
                tags: true,
                width: '50%' // need to override the changed default
            });
            $(".js-choose-tag-multiple").select2({
                placeholder: 'Select tag',
                tags: true,
                width: '50%' // need to override the changed default
            });
        });
    </script>
@endpush
