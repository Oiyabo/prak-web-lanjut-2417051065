@extends('layout.app')

@section('content')

	<div class="container">
		<h1>Edit Mata Kuliah</h1>

		<form action="{{ route('matakuliah.update', $mk->id) }}" method="POST">
			@csrf
			@method('PUT')

			<label for="nama_mk">Nama Mata Kuliah:</label>
			<input type="text" name="nama_mk" id="nama_mk" value="{{ $mk->nama_mk }}" required>

			<label for="sks">SKS:</label>
			<input type="number" name="sks" id="sks" value="{{ $mk->sks }}" required>

			<button type="submit" class="btn btn-primary">Update</button>
		</form>
	</div>

@endsection