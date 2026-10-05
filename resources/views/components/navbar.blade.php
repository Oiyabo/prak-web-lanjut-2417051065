<header>
    <nav class="site-nav" aria-label="Navigasi utama">
        <a class="brand" href="{{ route('user.index') }}" aria-label="Ruang Kelas, halaman daftar pengguna">
            <span class="brand__mark" aria-hidden="true">RK</span>
            <span class="brand__name">Ruang Kelas<small>PORTAL AKADEMIK</small></span>
        </a>
        <div class="site-nav__links">
            <a class="site-nav__link" href="{{ route('user.index') }}" @if (request()->routeIs('user.index')) aria-current="page" @endif>Pengguna</a>
            <a class="site-nav__link" href="{{ route('user.create') }}" @if (request()->routeIs('user.create')) aria-current="page" @endif>Tambah data</a>
        </div>
    </nav>
</header>