@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/categories') }}">Category</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
          </ol>
        </nav>
        <h1>Edit Category</h1>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card my-3">
          <form action="/admin/categories/{{ $category->id }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text"
                  class="form-control @error('name') is-invalid @endif" id="name"
                  placeholder="Name Category" name="name" required value="{{ old('name', $category->name) }}">
                  @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
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
