@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
          <li class="breadcrumb-item" aria-current="page">Article</li>
        </ol>
      </nav>
      <h1>Article</h1>
      <div class="col-lg mb-3">
        <a class="btn btn-primary" href="/admin/articles/create"><i class="bi bi-plus-lg"></i> Add Article</a>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        @if ($articles->count() == 0)
          <h2 class="fst-italic text-center">No Record Found</h2>
        @else
          <table class="table table-responsive table-bordered table-sm">
            <tr class="text-center">
              <th>No</th>
              <th>Title</th>
              <th>Category</th>
              <th>User</th>
              <th colspan="3">Action</th>
            </tr>
            @foreach ($articles as $item)
              <tr>
                <td>{{ ($articles->currentPage() - 1) * $articles->perPage() + $loop->iteration }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->category->name }}</td>
                <td>{{ $item->user->name }}</td>
                <td colspan="2" class="d-flex justify-content-center">
                  <a href="{{ url('/admin/articles/' . $item->id) }}" class="btn btn-sm btn-info text-white mx-2"><i
                      class="bi bi-eye-fill"></i></a> |
                  <a href="{{ url('/admin/articles/' . $item->id . '/edit') }}"
                    class="btn btn-sm btn-warning text-white mx-2"><i class="bi bi-pencil-fill"></i></a> |

                  <form action="/admin/articles/{{ $item->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger mx-2"><i class="bi bi-trash-fill"></i></button>
                </td>
                </form>
              </tr>
            @endforeach
          </table>
          {{ $articles->links() }}
        @endif

      </div>
    </div>
  </div>
@endsection
