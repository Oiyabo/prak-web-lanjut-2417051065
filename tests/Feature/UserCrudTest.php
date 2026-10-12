<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    public function test_user_edit_update_and_delete_routes_are_registered(): void
    {
        $this->assertTrue(Route::has('user.edit'));
        $this->assertTrue(Route::has('user.update'));
        $this->assertTrue(Route::has('user.destroy'));
    }

    public function test_user_table_renders_edit_and_delete_actions(): void
    {
        $id = '6ba7b810-9dad-11d1-80b4-00c04fd430c8';
        $user = (object) [
            'id' => $id,
            'nama' => 'Dewi Lestari',
            'nim' => '2417051065',
            'nama_kelas' => 'A',
        ];

        $html = view('components.user-table', ['users' => collect([$user])])->render();

        $this->assertStringContainsString(route('user.edit', $id), $html);
        $this->assertStringContainsString(route('user.destroy', $id), $html);
        $this->assertStringContainsString('value="DELETE"', $html);
    }

    public function test_empty_user_table_uses_the_container_width(): void
    {
        $html = view('components.user-table', ['users' => collect()])->render();

        $this->assertStringContainsString('user-table--empty', $html);
    }

    public function test_edit_user_view_renders_existing_user_data(): void
    {
        $user = (object) [
            'id' => '6ba7b810-9dad-11d1-80b4-00c04fd430c8',
            'nama' => 'Dewi Lestari',
            'nim' => '2417051065',
            'kelas_id' => 1,
        ];
        $kelas = collect([(object) ['id' => 1, 'nama_kelas' => 'A']]);

        $html = view('edit_user', [
            'title' => 'Edit User',
            'user' => $user,
            'kelas' => $kelas,
            'errors' => new ViewErrorBag,
        ])->render();

        $this->assertStringContainsString('value="Dewi Lestari"', $html);
        $this->assertStringContainsString('value="2417051065"', $html);
        $this->assertStringContainsString(route('user.update', $user->id), $html);
    }

    public function test_layout_renders_success_and_validation_feedback(): void
    {
        $errors = new ViewErrorBag;
        $errors->put('default', new MessageBag(['npm' => ['NPM tidak valid.']]));
        $html = view('layout.app', [
            'title' => 'User List',
            'success' => 'Data pengguna berhasil diperbarui.',
            'errors' => $errors,
        ])->render();

        $this->assertStringContainsString('Data pengguna berhasil diperbarui.', $html);
        $this->assertStringContainsString('NPM tidak valid.', $html);
    }
}
