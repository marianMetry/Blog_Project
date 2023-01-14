@extends('layouts.app')

@section('content')

@if (session()->has('error'))
    <div class="alert alert-danger">{{session()->get('error')}}</div>
@endif

<div class="clearfix">
    <a href="{{route('categories.create')}}" class="btn btn-success mb-2" style="float: right">Add Category</a>
</div>
@if (session()->has('success'))
<div class="alert alert-success">{{session()->get('success')}}</div>
@endif
<div class="card card-defult">
    <div class="card-header">All Categories</div>
    <div class="card-body" style="padding:0px">
        <table class="table">
            @foreach ($categories as $category )
            <tr>
                <td>{{$category->name}}</td>
                <td>
                    <a href="{{route('categories.edit',$category->id)}}" style="float: right; margin-left:3px" class="btn btn-success btn-sm ">Edit</a>
                    <form action="{{route('categories.destroy' , $category->id)}}" method="POST" >
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
