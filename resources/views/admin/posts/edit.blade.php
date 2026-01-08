@extends('adminlte::page')

@section('title', 'Edit Post')

@section('content_header')
    <h1>Edit Post</h1>
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#short_description'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
</script>
@endsection

@section('content')
<div class="card">
    <div class="card-body">

        <form method="POST"
              action="{{ route('admin.posts.update', $post) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       value="{{ old('title', $post->title) }}"
                       required>
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            @selected($post->category_id == $cat->id)>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Short Description --}}
            <div class="mb-3">
                <label class="form-label">Short Description</label>
                <textarea name="short_description"
                          id="short_description"  
                          class="form-control"
                          rows="3">{{ old('short_description', $post->short_description) }}</textarea>
            </div>

            {{-- Content --}}
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content"
                          id="content"
                          class="form-control"
                          rows="6"
                          required>{{ old('content', $post->content) }}</textarea>
            </div>

            {{-- Existing Image --}}
            @if($post->image)
                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>
                    <img src="{{ asset('storage/'.$post->image) }}"
                         width="150"
                         class="rounded">
                </div>
            @endif

            {{-- New Image --}}
            <div class="mb-3">
                <label class="form-label">Change Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="draft" @selected($post->status=='draft')>Draft</option>
                    <option value="published" @selected($post->status=='published')>Published</option>
                </select>
            </div>

            <button class="btn btn-primary">
                Update Post
            </button>

        </form>

    </div>
</div>
@endsection
