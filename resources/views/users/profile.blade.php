@extends('layouts.app')

@section('content')
<div class="card card-defult">
    <div class="card-header">Profile</div>
    <div class="card-body">
        <form method="POST" action="{{route('users.update',$user->id)}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-group pb-2" style="font-size: larger"> user Name :</label>
                <input type="text" class="form-control mb-3" name="name"  value="{{$user->name}}" >
            </div>
            <div class="mb-3">
                <label class="form-group pb-2" style="font-size: larger"> user Email :</label>
                <input type="text" class="form-control mb-3" name="email"  value="{{$user->email}}" >
            </div>
            <div class="mb-3">
                <label class="form-group pb-2" style="font-size: larger"> About :</label>
                <textarea class="form-control mb-3" name="about"  placeholder="Tell us about you">{{$profile->about}}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-group pb-2" style="font-size: larger"> Facebook :</label>
                <input type="text" class="form-control mb-3" name="facebook"  value="{{$profile->facebook}}" >
            </div>
            <div class="mb-3">
                <label class="form-group pb-2" style="font-size: larger"> Twitter :</label>
                <input type="text" class="form-control mb-3" name="twitter"  value="{{$profile->twitter}}" >
            </div>
            <div class="mb-3">
                <label class="form-group pb-2" style="font-size: larger"> picture :</label>
                <img src="{{asset($user->hasPicture() ? 'storage/'.$user->getPicture() : $user->getGravatar())}}" width="100px" height="100px" alt="">
                <input type="file" class="form-control mb-3 mt-3" name="picture">
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</div>
@endsection
