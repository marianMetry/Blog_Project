@extends('layouts.app')

@section('styleSheet')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0-beta.0/dist/trix.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="card card-defult">
    <div class="card-header">{{isset($post) ? 'Edit Post' : 'Add New Post'}}</div>
    <div class="card-body">
        <form method="POST" action="{{ isset($post)? route('posts.update',$post->id): route('posts.store')}}" enctype="multipart/form-data">
            @csrf
            @if (isset($post))
                @method('PUT')
            @endif
            <div class="mb-3">
                <label class="form-group pb-2" style="font-size: larger"> Titel :</label>
                <input type="text" class="form-control mb-3" name="titel" value="{{isset($post)? $post->titel : ''}}" placeholder="Post titel">
                @error('titel')
                    <span class="alert alert-danger py-3">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-group pb-2" style="font-size: larger"> Description :</label>
                <textarea class="form-control mb-3" name="description" placeholder="Post description">{{isset($post) ? $post->description : ''}}</textarea>
                @error('description')
                    <span class="alert alert-danger py-3">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-group pb-2" style="font-size: larger"> Content :</label>
                <input id="x" type="hidden" name="content" value="{{isset($post)? $post->content : ''}}">
                <trix-editor input="x"></trix-editor>
                @error('content')
                    <span class="alert alert-danger py-3">{{ $message }}</span>
                @enderror
            </div>
            @if (isset($post))
                <div class="form-group">
                    <img src="{{asset('storage/'. $post->image)}}" width="100%" height="50%" alt="">
                </div>
            @endif
            <div class="mb-3">
                <label class="form-group pb-2" style="font-size: larger"> Image :</label>
                <input type="file" class="form-control mb-3" name="image" placeholder="Post Image">
                @error('image')
                    <span class="alert alert-danger py-3">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="selectCategory">Select a Category</label>
                <select class="form-select" id="selectCategory" name="categoryId">
                    @foreach ($categories as $category )
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            @if (! $tags->count() ==  0)
            <div class="form-group mb-3">
                <label for="selectTag">Select a Tag</label>
                <select class="form-select tags" id="selectTag" name="tag[]" multiple>
                    @foreach ($tags as $tag )

                    <option value="{{$tag->id}}"
                            @if ($post->hasTag($tag->id))
                                selected
                            @endif

                        >{{$tag->name}}</option>
                    @endforeach
                </select>
            </div>

            @endif
            <button type="submit" class="btn btn-primary">{{isset($post)?'Edit':'Add'}}</button>
        </form>
    </div>
</div>
@endsection
@section('scripts')
 <script src="https://unpkg.com/trix@2.0.0-beta.0/dist/trix.umd.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 <script>
    $(document).ready(function() {
    $('.tags').select2();
});
 </script>
@endsection
