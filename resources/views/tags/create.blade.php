@extends('layouts.app')

@section('content')
<div class="card card-defult">
    <div class="card-header">{{isset($tag)? 'Edit Tag' : 'Add New Tag'}}</div>
    <div class="card-body">
        <form method="POST" action="{{ isset($tag) ? route('tags.update',$tag->id) : route('tags.store')}}">
            @csrf
            @if (isset($tag))
                @method('PATCH')
            @endif
            <div class="mb-3">
                <label class="form-group pb-2" style="font-size: larger"> Tag Name :</label>
                <input type="text" class="form-control mb-3" name="name"  value="{{ isset($tag) ? $tag->name : ''}}" placeholder="Tag Name">
                @error('name')
                    <span class="alert alert-danger py-3">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{isset($tag) ? 'Edit' :'Add'}}</button>
        </form>
    </div>
</div>
@endsection
