@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/articles') }}">Article</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
          </ol>
        </nav>
        <h1>Create Article</h1>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card my-3">
          <form action="/admin/articles" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text"
                  class="form-control @error('title') is-invalid @endif" id="title"
                  placeholder="Title Article" name="title" value="{{ old('title') }}" required>
                  @error('title')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="mb-3">
                <label for="category_id" class="form-label d-block">Category</label>
                <select
                  class="select-category @error('category_id') is-invalid @endif" name="category_id" id="category_id" style="width: 100%;" required>
                  @foreach ($category as $item)
                    @if (old('category_id') == $item->id)
                      <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else  
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                  @endforeach
                </select>
                @error('category')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                  <label for="image" class="form-label">Image</label>
                  <img class="img-preview img-fluid mb-3 col-sm-2">
                  <input
                    class="form-control @error('image') is-invalid @endif" type="file" name="image" id="image" required onchange="previewImage()">
                  @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="mb-3">
                  <label for="content" class="form-label">Content</label>
                  @error('content')
                    <small class="d-block text-danger">{{ $message }}</small>
                  @enderror
                  <input id="content" type="hidden" name="content" class="@error('content') is-invalid @endif">
                  <trix-editor input="content">
                  </trix-editor>
              </div>
            </div>
            <div class="card-footer
                  text-end">
              <button type="submit" class="btn btn-primary">SUBMIT</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      $('.select-category').select2();
    });
    document.addEventListener('trix-file-accept', function(e) {
      e.preventDefault();
    });

    function previewImage() {

      const image = $('#image')[0];
      const imgPreview = $('.img-preview')[0];

      imgPreview.style.display = 'block';

      const blob = URL.createObjectURL(image.files[0]);
      imgPreview.src = blob;
    }
  </script>
@endsection
