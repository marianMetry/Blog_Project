@extends('layouts.app')

@section('content')
<div class="card card-defult">
    <div class="card-header">{{isset($category)? 'Edit Category' : 'Add New Category'}}</div>
    <div class="card-body">
        <form method="POST" action="{{ isset($category) ? route('categories.update',$category->id) : route('categories.store')}}">
            @csrf
            @if (isset($category))
                @method('PATCH')
            @endif
            <div class="mb-3">
                <label class="form-group pb-2" style="font-size: larger"> Category Name :</label>
                <input type="text" class="form-control mb-3" name="name"  value="{{ isset($category) ? $category->name : ''}}" placeholder="Category Name">
                @error('name')
                    <span class="alert alert-danger py-3">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{isset($category) ? 'Edit' :'Add'}}</button>
        </form>
    </div>
</div>
@endsection
