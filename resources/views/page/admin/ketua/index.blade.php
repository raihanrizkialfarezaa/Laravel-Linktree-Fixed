@extends('layouts.dashboard')

@section('title')
    Link
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Link</h1>
    <a href="{{ route('link-kantor') }}" class="btn btn-primary">Go To Home</a>
    <a href="{{ route('ketua.create') }}" class="btn btn-primary">Tambah Data</a>
</div>

<!-- Content Row -->
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Links</th>
                <th>Category</th>
                <th class="text-center">Aksi</th>
            </tr>
            @forelse ($ketua as $row)
                <tr>
                    <th>{{ $row->link }}</th>
                    <th>{{ $row->category->name }}</th>
                    <th class="text-center">
                        <form action="{{ route('ketua.edit', $row->id) }}" class="d-inline">
                            @method('PUT')
                            <button class="btn btn-primary">
                                Edit
                            </button>
                        </form> |
                        <form action="{{ route('ketua.destroy', $row->id) }}" method="POST" class="d-inline">
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
    </div>
</div>
@endsection