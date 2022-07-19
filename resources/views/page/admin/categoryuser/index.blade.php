@extends('layouts.dashboard')

@section('title')
    Link
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Category Link User</h1>
    <a href="{{ route('link-kantor') }}" class="btn btn-primary">Go To Home</a>
    <a href="{{ route('categoryuser.create') }}" class="btn btn-primary">Tambah Data</a>
</div>

<!-- Content Row -->
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Category Name</th>
                <th class="text-center">Aksi</th>
            </tr>
            @forelse ($category as $row)
                <tr>
                    <th>{{ $row->name }}</th>
                    <th class="text-center">
                        <form action="{{ route('categoryuser.edit', $row->id) }}" class="d-inline">
                            @method('PUT')
                            <button class="btn btn-primary">
                                Edit
                            </button>
                        </form> |
                        <form action="{{ route('categoryuser.destroy', $row->id) }}" method="POST" class="d-inline">
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