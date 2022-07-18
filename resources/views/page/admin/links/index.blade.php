@extends('layouts.dashboard')

@section('title')
    Link
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Link</h1>
    <a href="{{ route('link-kantor') }}" class="btn btn-primary">Go To Home</a>
    <a href="{{ route('links.create') }}" class="btn btn-primary">Tambah Data</a>
</div>

<!-- Content Row -->
<div class="container">
    <form method="GET">
        <div class="form-group mb-5">
          <input 
            type="text" 
            name="search" 
            value="{{ request()->get('search') }}" 
            class="form-control" 
            placeholder="Search..." 
            aria-label="Search" 
            aria-describedby="button-addon2">
          <button class="btn btn-success mt-3" type="submit" id="button-addon2">Search</button>
        </div>
    </form>
    <div class="table-responsive">
        @if ($links->count())
            <table class="table table-bordered">
                <tr>
                    <th>User</th>
                    <th>Links</th>
                    <th class="text-center">Aksi</th>
                </tr>
                @forelse ($links as $row)
                    <tr>
                        <th>{{ $row->user->name }}</th>
                        <th>{{ $row->link }}</th>
                        <th class="text-center">
                            <form action="{{ route('links.edit', $row->id) }}" class="d-inline">
                                @method('PUT')
                                <button class="btn btn-primary">
                                    Edit
                                </button>
                            </form> |
                            <form action="{{ route('links.destroy', $row->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">
                                    Hapus
                                </button>

                            </form>
                        </th>
                    </tr>
                @empty
                    <td colspan="4" class="text-center">Data Masih Kosong!</td>
                @endforelse
            </table>
        @else
            <h1 class="text-center mt-5">Data tidak di temukan</h1>
        @endif
        @if (request()->get('search') == null && empty(request()->get('showAll')) && $links->count() > 10)
            {{ $links->links() }}
            <form method="GET">
                <div class="form-group">
                    <input type="hidden" value="showAll" name="showAll">
                    <button class="btn btn-success mt-3" type="submit" id="button-addon2">Show All</button>
                </div>
            </form>
        @elseif (empty(request()->get('search')) && $links->count() > 10)
            <form method="GET">
                <div class="form-group">
                    <input type="hidden" value="showAll" name="showAll">
                    <button class="btn btn-success mt-3" type="submit" id="button-addon2">Show All</button>
                </div>
            </form>
        @else
            
        @endif
    </div>
</div>
@endsection