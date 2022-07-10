@extends('layouts.dashboard')

@section('title')
    edit admin
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit user</h1>
</div>

<!-- Content Row -->
<div class="page-inner mt--5">
	<div class="row">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-header">
					<div class="card-head-row">
						<div class="card-title">Edit users</div>
						<a href="{{ route('users.index') }}" class="btn btn-primary btn-sm ml-auto">Back</a>
					</div>
				</div>
				
				<div class="card-body">
					<form action="{{ route('users.update', $users->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
						@csrf
                        <div class="form-group">
							<label for="judul">Email</label>
							<input type="text" value="{{ $users->email }}" class="form-control" name="email">
						</div>
						<div class="form-group">
							<label for="judul">Nama</label>
							<input type="text" value="{{ $users->name }}" class="form-control" name="name">
						</div>
						<div class="form-group">
							<label for="judul">Password</label>
							<input type="text" class="form-control" name="password">
                        </div>
						<div class="form-group">
							<label for="judul">Roles</label>
							<select name="roles" id="">
								@if (old('roles', $users->roles) == $roles)
									<option value="{{ $roles }}" selected>{{ $roles }}</option>
								@else
									<option value="ADMIN">Admin</option>
									<option value="USER">User</option>
									<option value="KETUA">Ketua</option>
								@endif
							</select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        </div>
@endsection