@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9 mx-auto">
                <h2 class="h2">Edit Post</h2>
                <form method="post" action="{{ route('posts.update', [$post->slug]) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{$post->title}}">

                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="summary" class="font-weight-bold">Summary</label>
                        <textarea class="form-control @error('summary') is-invalid @enderror" name="summary" id="summary" cols="30" rows="3">{{$post->summary}}</textarea>

                        @error('summary')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content" class="font-weight-bold">Content</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" cols="30" rows="10">{{$post->content}}</textarea>

                        @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <h6 class="font-weight-bold">Category</h6>

                        <select class="js-choose-category-multiple @error('categories') is-invalid @enderror" name="categories[]" multiple="multiple">
                            @foreach($categories as $key => $category)
                                <option value="{{$category->title}}:{{$category->id}}" {{in_array($category->id, $post->categories->pluck('id')->toArray()) ? 'selected' : ''}}>{{ $category->title }}</option>
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
                                <option value="{{$tag->title}}:{{$tag->id}}" {{in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'selected' : ''}}>{{ $tag->title }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                    </div>


                    <button type="submit" class="btn btn-primary">Update</button>
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
