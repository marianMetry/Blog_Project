@extends('layouts.app')

@section('content')
    @if (session()->has('error'))
        <div class="alert alert-danger">{{session()->get('error')}}</div>
    @endif

<div class="clearfix">
    <a href="{{route('tags.create')}}" class="btn btn-success mb-2" style="float: right">Add Tag</a>
</div>
@if (session()->has('success'))
    <div class="alert alert-success">{{session()->get('success')}}</div>
@endif
<div class="card card-defult">
    <div class="card-header">All tags</div>
    <div class="card-body" style="padding:0px">
        <table class="table">
            @foreach ($tags as $tag )
            <tr>
                <td>{{$tag->name}}<span class="badge bg-primary" style="margin-left: 10px">{{$tag->posts->count()}}</span></td>
                <td>
                    <a href="{{route('tags.edit',$tag->id)}}" style="float: right; margin-left:3px" class="btn btn-success btn-sm ">Edit</a>
                    <form action="{{route('tags.destroy' , $tag->id)}}" method="POST" >
                        @csrf
                        @method('DELETE')
                    <button style="float: right" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
