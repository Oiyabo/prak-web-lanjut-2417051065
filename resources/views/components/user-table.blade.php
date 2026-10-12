@props(['users'])

<div class="table-frame">
    <div class="table-scroll" role="region" aria-label="Tabel daftar pengguna" tabindex="0">
        <table class="user-table {{ $users->isEmpty() ? 'user-table--empty' : '' }}">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nama pengguna</th>
                    <th scope="col">NPM</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="user-table__id" title="{{ $user->id }}">{{ substr((string) $user->id, 0, 8) }}</td>
                        <td>
                            <div class="student">
                                <span class="student__avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr($user->nama, 0, 1)) }}</span>
                                <span class="student__name">{{ $user->nama }}</span>
                            </div>
                        </td>
                        <td class="npm">{{ $user->nim }}</td>
                        <td><span class="class-tag">{{ $user->nama_kelas }}</span></td>
                        <td>
                            <div class="user-table__actions">
                                <a class="button button--secondary button--row" href="{{ route('user.edit', $user->id) }}">Edit</a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button button--danger button--row" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            <strong>Belum ada pengguna</strong>
                            Tambahkan data pertama untuk mengisi direktori ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>