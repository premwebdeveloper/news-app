@extends('adminlte::page')

@section('title','Add Category')

@section('content_header')
    <h1>Add Category</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf

            <input name="name" class="form-control mb-3" placeholder="Category Name">

            <select name="status" class="form-control mb-3">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>

            <button class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
