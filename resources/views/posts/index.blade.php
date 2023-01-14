@extends('layouts.app')

@section('content')
<div class="clearfix">
    <a href="{{route('posts.create')}}" class="btn btn-success mb-2" style="float: right">Add post</a>
</div>
@if (session()->has('success'))
<div class="alert alert-success">{{session()->get('success')}}</div>
@endif
<div class="card card-defult">
    <div class="card-header">All posts</div>
    @if ($posts->count()>0)
    <div class="card-body" style="padding:0px">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Titel</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post )
                <tr>
                    <td>{{$post->id}}</td>
                    <td>
                        <img src="{{asset('storage/'. $post->image)}}" width="100px" height="50px" alt="">
                    </td>
                    <td>{{$post->titel}}</td>
                    <td>
                        <form action="{{route('posts.destroy', $post->id)}}" method="POST" >
                            @csrf
                            @method('DELETE')
                        <button style="float: right;; margin-left:3px" class="btn btn-danger btn-sm">{{$post->trashed() ? 'Delete' : 'Trashed'}}</button>
                        </form>
                        @if (!$post->trashed())
                            <a href="{{route('posts.edit', $post->id)}}" style="float: right; margin-left:3px" class="btn btn-success btn-sm ">Edit</a>
                        @else
                            <a href="{{route('trashed.restore', $post->id)}}" style="float: right; margin-left:3px" class="btn btn-success btn-sm ">Restore</a>
                        @endif
                        <a href="#" style="float: right; margin-left:3px" class="btn btn-warning btn-sm ">View</a>

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    @else
    <div class="card-body" style="padding:0px">
        <h4 class="text-center py-5">No Posts Yet</h4>
    </div>


    @endif
</div>
@endsection
