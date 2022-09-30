@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/admin/articles') }}">Article</a></li>
          <li class="breadcrumb-item" aria-current="page">Show</li>
        </ol>
      </nav>
      <h1>Article</h1>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card">
          <img src="{{ asset('storage/' . $article->image) }}" alt="article image" class="col-sm-5 mx-auto mt-3">
          <div class="card-body">
            <h4 class="card-title">{{ $article->title }}</h4>
            <span class="badge text-bg-danger">{{ $article->category->name }}</span class="badge text-bg-danger">
            <small class="d-block mt-2">Created by {{ $article->user->name }} at
              {{ $article->created_at->diffForHumans() }}</small>
            <p class="card-text">{!! $article->content !!}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
