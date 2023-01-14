@extends('layouts.app')

@section('content')
@if (session()->has('success'))
<div class="alert alert-success">{{session()->get('success')}}</div>
@endif
<div class="card card-defult">
    <div class="card-header">All users</div>
    @if ($users->count()>0)
    <div class="card-body" style="padding:0px">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>UserName</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user )
                <tr>
                    <td>{{$user->id}}</td>
                    <td>
                        <img src="{{ $user->hasPicture() ? asset('storage/'.$user->getPicture()) : $user->getGravatar()}}" style="border-radius: 50%; width:50px; height:50px" alt="">
                    </td>
                    <td>{{$user->name}}</td>
                    <td>
                        @if (! $user->isAdmin())
                            <form action="{{route('users.makeAdmin' , $user->id)}}" method="post">
                                @csrf
                                <button class="btn btn-success" type="submit">Make Admin</button>
                            </form>
                        @else
                        <form action="{{route('users.removeAdmin' , $user->id)}}" method="post">
                            @csrf
                            <button class="btn btn-danger" type="submit">Admin</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    @else
    <div class="card-body" style="padding:0px">
        <h4 class="text-center py-5">No users Yet</h4>
    </div>


    @endif
</div>
@endsection

