@extends('adminlte::page')

@section('title','Categories')

@section('content_header')
<h1>Categories</h1>
@endsection

@section('js')
<script>
    $(function() {
        $('#categoriesTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            responsive: true
        });
    });
</script>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped" id="categoriesTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->slug }}</td>
                    <td>
                        <span class="badge {{ $cat->status ? 'bg-success':'bg-danger' }}">
                            {{ $cat->status ? 'Active':'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.categories.edit',$cat) }}"
                            class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('admin.categories.destroy',$cat) }}"
                            method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete category?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection