@extends('layouts.dashboard')

@section('title')
    admin
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah link</h1>
</div>

<!-- Content Row -->
<div class="page-inner mt--5">
	<div class="row">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-header">
					<div class="card-head-row">
						<div class="card-title">Tambah category</div>
						<a href="{{ route('category.index') }}" class="btn btn-primary btn-sm ml-auto">Back</a>
					</div>
				</div>
			<div class="card-body">
				<form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					@if ($message = Session::get('gagal'))
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">×</button> 
							<strong>{{ $message }}</strong>
						</div>
					@endif
					<div class="form-group">
						<label for="judul">Category Name</label>
						<input type="text" class="form-control" name="name">
					</div>
					<div class="form-group">
						<button class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
@endsection