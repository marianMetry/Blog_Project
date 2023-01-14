@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
            <div class="col-md-4 text-center ">
                <div class="card bg-danger text-white">
                    <div class="card-header">Users</div>
                    <div class="card-body">{{$users_count}}</div>
                </div>
            </div>
            <div class="col-md-4 text-center ">
                <div class="card bg-success text-white">
                    <div class="card-header">Posts</div>
                    <div class="card-body">{{$posts_count}}</div>
                </div>
            </div>
            <div class="col-md-4 text-center ">
                <div class="card bg-info text-white">
                    <div class="card-header">Categories</div>
                    <div class="card-body">{{$categories_count}}</div>
                </div>
            </div>

            </div>
        </div>
    </div>
</div>
@endsection

