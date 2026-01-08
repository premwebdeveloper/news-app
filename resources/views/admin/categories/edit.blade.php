@extends('adminlte::page')

@section('title','Edit Category')

@section('content_header')
    <h1>Edit Category</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST"
              action="{{ route('admin.categories.update',$category) }}">
            @csrf @method('PUT')

            <input name="name" value="{{ $category->name }}"
                   class="form-control mb-3">

            <select name="status" class="form-control mb-3">
                <option value="1" @selected($category->status)>Active</option>
                <option value="0" @selected(!$category->status)>Inactive</option>
            </select>

            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
