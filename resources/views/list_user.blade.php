@extends('layout.app')

@section('content')
    <section class="directory" aria-labelledby="directory-title">
        <div class="directory__intro">
            <div>
                <p class="eyebrow">Data akademik <span> / </span> Pengguna</p>
                <h1 id="directory-title">Daftar pengguna<span>.</span></h1>
                <p class="directory__description">Direktori mahasiswa dan kelas yang terdaftar.</p>
            </div>
            <a class="button button--primary" href="{{ route('user.create') }}">
                <span aria-hidden="true">+</span>
                Tambah pengguna
            </a>
        </div>

        <div class="directory__summary" aria-label="Ringkasan daftar">
            <span class="summary__marker" aria-hidden="true"></span>
            <p><strong>{{ $users->count() }}</strong> pengguna terdaftar</p>
            <span class="summary__note">Diperbarui dari data kelas</span>
        </div>

        <x-user-table :users="$users" />
    </section>
@endsection