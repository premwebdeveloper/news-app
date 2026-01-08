@extends('adminlte::page')

@section('title', 'Add Post')

@section('content_header')
    <h1>Add Post</h1>
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
              action="{{ route('admin.posts.store') }}"
              enctype="multipart/form-data">
            @csrf

            {{-- Title --}}
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       value="{{ old('title') }}"
                       required>
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">
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
                          rows="3">{{ old('short_description') }}</textarea>
            </div>

            {{-- Content --}}
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content"
                          id="content"
                          class="form-control"
                          rows="6"
                          required>{{ old('content') }}</textarea>
            </div>

            {{-- Image --}}
            <div class="mb-3">
                <label class="form-label">Featured Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>

            <button class="btn btn-primary">
                Save Post
            </button>

        </form>

    </div>
</div>
@endsection
