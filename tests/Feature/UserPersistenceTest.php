<?php

namespace Tests\Feature;

use App\Models\Kelas;
use App\Models\UserModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserPersistenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_creation_generates_a_uuid_primary_key(): void
    {
        $kelas = Kelas::create(['nama_kelas' => 'A']);

        $response = $this->post(route('user.store'), [
            'nama' => 'Dewi Lestari',
            'npm' => '2417051065',
            'kelas_id' => $kelas->id,
        ]);

        $response->assertRedirect(route('user.index'));
        $user = UserModel::firstOrFail();
        $this->assertTrue(Str::isUuid($user->id));
        $this->assertSame('Dewi Lestari', $user->nama);
    }

    public function test_user_can_be_edited_and_updated(): void
    {
        $user = $this->createUser();
        $newKelas = Kelas::create(['nama_kelas' => 'B']);

        $this->get(route('user.edit', $user->id))
            ->assertOk()
            ->assertSee('value="2417051065"', false);

        $this->put(route('user.update', $user->id), [
            'nama' => 'Dewi Lestari Putri',
            'npm' => '2417051099',
            'kelas_id' => $newKelas->id,
        ])
            ->assertRedirect(route('user.index'))
            ->assertSessionHas('success', 'Data pengguna berhasil diperbarui.');

        $this->assertDatabaseHas('user', [
            'id' => $user->id,
            'nama' => 'Dewi Lestari Putri',
            'nim' => '2417051099',
            'kelas_id' => $newKelas->id,
        ]);
    }

    public function test_invalid_user_update_shows_validation_feedback_without_changing_data(): void
    {
        $user = $this->createUser();

        $this->from(route('user.edit', $user->id))
            ->put(route('user.update', $user->id), [
                'nama' => '',
                'npm' => '2417051065',
                'kelas_id' => $user->kelas_id,
            ])
            ->assertRedirect(route('user.edit', $user->id))
            ->assertSessionHasErrors('nama');

        $this->get(route('user.edit', $user->id))
            ->assertOk()
            ->assertSee('The nama field is required.');

        $this->assertDatabaseHas('user', [
            'id' => $user->id,
            'nama' => 'Dewi Lestari',
        ]);
    }

    public function test_user_can_be_deleted(): void
    {
        $user = $this->createUser();

        $this->delete(route('user.destroy', $user->id))
            ->assertRedirect(route('user.index'))
            ->assertSessionHas('success', 'Data pengguna berhasil dihapus.');

        $this->assertDatabaseMissing('user', ['id' => $user->id]);
    }

    private function createUser(): UserModel
    {
        $kelas = Kelas::create(['nama_kelas' => 'A']);

        return UserModel::create([
            'nama' => 'Dewi Lestari',
            'nim' => '2417051065',
            'kelas_id' => $kelas->id,
        ]);
    }
}
