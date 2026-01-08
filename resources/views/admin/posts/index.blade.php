@extends('adminlte::page')

@section('content_header')
<h1>Posts</h1>
@endsection

@section('js')
<script>
	$(function() {
		$('#postsTable').DataTable({
			paging: true,
			searching: true,
			ordering: true,
			responsive: true,
			pageLength: 10
		});
	});
</script>
@endsection

@section('content')
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
@endsection