@extends('adminlte::page')

@section('content_header')
<h1>Posts</h1>
@endsection

@section('js')
<script>
	$(function() {
		$('#postsTable').DataTable({
			// Use Laravel's paginator; disable DataTables paging UI
			paging: false,
			info: false,
			// Searching is handled server-side via the form above
			searching: false,
			ordering: true,
			responsive: true,
			lengthChange: false
		});
	});
</script>
@endsection

@section('content')
<div class="mb-3">
	<form method="GET" action="{{ route('admin.posts.index') }}" class="form-inline d-flex gap-2">
		<input
			type="text"
			name="search"
			value="{{ $search ?? '' }}"
			class="form-control"
			placeholder="Search in all posts..."
		>
		<button type="submit" class="btn btn-primary">
			Search
		</button>
		@if(!empty($search))
			<a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
				Clear
			</a>
		@endif
	</form>
</div>

<table class="table table-bordered table-striped" id="postsTable">
	<thead>
		<tr>
			<th>Title</th>
			<th>Category</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($posts as $post)
		<tr>
			<td>{{ $post->title }}</td>
			<td>{{ $post->category->name }}</td>
			<td>{{ $post->status }}</td>
			<td>
				<a href="{{ route('admin.posts.edit',$post) }}" class="btn btn-warning btn-sm">Edit</a>
				<form method="POST" action="{{ route('admin.posts.destroy',$post) }}" style="display:inline">
					@csrf @method('DELETE')
					<button class="btn btn-danger btn-sm">Delete</button>
				</form>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

{{-- Laravel pagination links for large datasets (Bootstrap 5 style, centered in one row) --}}
<div class="mt-3 d-flex justify-content-center">
	{{ $posts->links('pagination::bootstrap-5') }}
</div>
@endsection