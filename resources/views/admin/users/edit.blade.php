@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1>Edit User</h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.users.update',$user) }}">
        @csrf @method('PUT')
        <input name="name" value="{{ $user->name }}" class="form-control mb-2">
        <input name="email" value="{{ $user->email }}" class="form-control mb-2">
        <select name="role" class="form-control mb-2">
            <option value="user" @selected($user->role=='user')>User</option>
            <option value="admin" @selected($user->role=='admin')>Admin</option>
        </select>
        <button class="btn btn-primary">Update</button>
    </form>
@endsection
