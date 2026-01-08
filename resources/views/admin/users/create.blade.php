@extends('adminlte::page')

@section('title', 'Add User')

@section('content_header')
    <h1>Add User</h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <input name="name" class="form-control mb-2" placeholder="Name">
        <input name="email" class="form-control mb-2" placeholder="Email">
        <input name="password" type="password" class="form-control mb-2" placeholder="Password">
        <select name="role" class="form-control mb-2">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <button class="btn btn-primary">Save</button>
    </form>
@endsection
