@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Dashboard') }}</div>

          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <div class="d-flex flex-wrap justify-content-around">
              <div class="card text-bg-primary mb-3" style="min-width: 14rem;">
                <div class="card-header">Category</div>
                <div class="card-body d-flex align-items-center">
                  <p class="card-text m-0 fs-1 text-center">{{ $category }}</p>
                  <i class="bi bi-tag-fill ms-auto fs-1"></i>
                </div>
                <div class="card-footer text-end">
                  <a href="{{ url('/admin/categories') }}" class="card-link text-white text-decoration-none">More info <i
                      class="bi bi-arrow-right-circle"></i></a>
                </div>
              </div>
              <div class="card text-bg-danger mb-3" style="min-width: 14rem;">
                <div class="card-header">Article</div>
                <div class="card-body d-flex align-items-center">
                  <p class="card-text m-0 fs-1 text-center">{{ $article }}</p>
                  <i class="bi bi-file-richtext ms-auto fs-1"></i>
                </div>
                <div class="card-footer text-end">
                  <a href="{{ url('/admin/articles') }}" class="card-link text-white text-decoration-none">More info <i
                      class="bi bi-arrow-right-circle"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endsection
