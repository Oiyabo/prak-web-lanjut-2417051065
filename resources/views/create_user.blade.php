@extends('layout.app')

@section('content')
    <section class="create-page" aria-labelledby="create-title">
        <div class="create-page__intro">
            <a class="create-page__back" href="{{ route('user.index') }}">
                <span aria-hidden="true">&larr;</span>
                Kembali ke direktori
            </a>
            <p class="eyebrow">Data pengguna <span>/</span> Entri baru</p>
            <h1 id="create-title">Tambah pengguna<span>.</span></h1>
            <p class="create-page__description">Lengkapi identitas mahasiswa dan pilih kelas untuk menambahkan satu record ke direktori.</p>
        </div>

        <div class="form-panel">
            <div class="form-panel__topline">
                <span>FORMULIR PENGGUNA</span>
                <span>01 <span aria-hidden="true">/</span> 03</span>
            </div>
            <form class="user-form" action="{{ route('user.store') }}" method="POST">
            @csrf

                <div class="form-field">
                    <div class="form-field__heading">
                        <label for="nama">Nama lengkap</label>
                        <span class="form-field__number">01</span>
                    </div>
                    <input id="nama" name="nama" type="text" value="{{ old('nama') }}" autocomplete="name" placeholder="Nama mahasiswa" aria-describedby="nama-error" required autofocus>
                    @error('nama')
                        <p class="form-field__error" id="nama-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-field">
                    <div class="form-field__heading">
                        <label for="npm">NPM</label>
                        <span class="form-field__number">02</span>
                    </div>
                    <input id="npm" name="npm" type="text" value="{{ old('npm') }}" inputmode="numeric" placeholder="Contoh: 2417051065" aria-describedby="npm-error" required>
                    @error('npm')
                        <p class="form-field__error" id="npm-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-field">
                    <div class="form-field__heading">
                        <label for="kelas_id">Kelas</label>
                        <span class="form-field__number">03</span>
                    </div>
                    <select name="kelas_id" id="kelas_id" aria-describedby="kelas-error" required>
                        <option value="">Pilih kelas</option>
                        @foreach ($kelas as $kelasItem)
                            <option value="{{ $kelasItem->id }}" @selected(old('kelas_id') == $kelasItem->id)>{{ $kelasItem->nama_kelas }}</option>
                        @endforeach
                    </select>
                    @error('kelas_id')
                        <p class="form-field__error" id="kelas-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-panel__actions">
                    <button class="button button--primary" type="submit">Simpan pengguna <span aria-hidden="true">&rarr;</span></button>
                    <a class="button button--secondary" href="{{ route('user.index') }}">Batal</a>
                </div>
            </form>
        </div>
    </section>
@endsection