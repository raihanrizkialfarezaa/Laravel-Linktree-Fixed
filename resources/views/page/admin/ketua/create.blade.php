@extends('layouts.dashboard')

@section('title')
    admin
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah link ketua</h1>
</div>

<!-- Content Row -->
<div class="page-inner mt--5">
	<div class="row">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-header">
					<div class="card-head-row">
						<div class="card-title">Tambah link ketua</div>
						<a href="{{ route('ketua.index') }}" class="btn btn-primary btn-sm ml-auto">Back</a>
					</div>
				</div>
			<div class="card-body">
				<form action="{{ route('ketua.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label for="judul">Link Placeholder</label>
						<input type="text" class="form-control" name="name">
					</div>
					<div class="form-group">
						<label for="judul">Link</label>
						<input type="text" class="form-control" name="link">
					</div>
					<div class="form-group">
						<label for="judul">Category</label>
						<select class="form-control" name="category_id" id="">
							@foreach ($category as $cat)
								<option value="{{ $cat->id }}">{{ $cat->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<button class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
@endsection