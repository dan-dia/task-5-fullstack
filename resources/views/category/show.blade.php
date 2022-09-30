@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/admin/categories') }}">Category</a></li>
          <li class="breadcrumb-item" aria-current="page">Show</li>
        </ol>
      </nav>
      <h1>Categories</h1>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-4">
        <div class="card p-4">
          <div class="card-text">
            <p>{{ $category->name }}</p>
            <p>Created by {{ $category->user->name }} at {{ $category->created_at->diffForHumans() }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
