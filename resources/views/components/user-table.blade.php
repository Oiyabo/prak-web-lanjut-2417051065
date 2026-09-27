@props(['users'])

<div class="table-frame">
    <div class="table-scroll" role="region" aria-label="Tabel daftar pengguna" tabindex="0">
        <table class="user-table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nama pengguna</th>
                    <th scope="col">NPM</th>
                    <th scope="col">Kelas</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="user-table__id">{{ str_pad((string) $user->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <div class="student">
                                <span class="student__avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr($user->nama, 0, 1)) }}</span>
                                <span class="student__name">{{ $user->nama }}</span>
                            </div>
                        </td>
                        <td class="npm">{{ $user->nim }}</td>
                        <td><span class="class-tag">{{ $user->nama_kelas }}</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="empty-state">
                            <strong>Belum ada pengguna</strong>
                            Tambahkan data pertama untuk mengisi direktori ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>