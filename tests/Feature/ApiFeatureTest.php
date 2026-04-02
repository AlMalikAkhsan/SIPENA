<?php

namespace Tests\Feature;

use App\Models\Laporan;
use App\Models\LaporanFoto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_laporan_rejects_more_than_five_photos_without_creating_record(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $files = [];
        for ($i = 0; $i < 6; $i++) {
            $files[] = UploadedFile::fake()->create("foto-{$i}.jpg", 100, 'image/jpeg');
        }

        $response = $this->post('/api/laporan', [
            'judul' => 'Jalan rusak',
            'isi' => 'Ada kerusakan di jalan utama',
            'lokasi' => 'RT 01',
            'foto' => $files,
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => false,
                'message' => 'Maksimal 5 foto',
            ]);

        $this->assertDatabaseCount('laporans', 0);
        $this->assertDatabaseCount('laporan_fotos', 0);
    }

    public function test_update_laporan_cannot_delete_photo_from_another_laporan(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $laporan = Laporan::create([
            'user_id' => $user->id,
            'judul' => 'Laporan saya',
            'isi' => 'Isi awal',
            'status' => 'menunggu',
        ]);

        $otherLaporan = Laporan::create([
            'user_id' => $otherUser->id,
            'judul' => 'Laporan orang lain',
            'isi' => 'Rahasia',
            'status' => 'menunggu',
        ]);

        $foreignPhoto = LaporanFoto::create([
            'laporan_id' => $otherLaporan->id,
            'foto_path' => 'laporan/orang-lain.jpg',
            'urutan' => 0,
        ]);

        Storage::disk('public')->put($foreignPhoto->foto_path, 'dummy');

        Sanctum::actingAs($user);

        $response = $this->post("/api/laporan/{$laporan->id}", [
            'judul' => 'Laporan saya',
            'isi' => 'Isi diperbarui',
            'lokasi' => 'RT 02',
            'hapus_foto' => [$foreignPhoto->id],
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => false,
                'message' => 'Foto yang dipilih tidak valid',
            ]);

        $this->assertDatabaseHas('laporan_fotos', [
            'id' => $foreignPhoto->id,
            'laporan_id' => $otherLaporan->id,
        ]);
        Storage::disk('public')->assertExists($foreignPhoto->foto_path);
    }

    public function test_profile_update_persists_gender_and_birth_date(): void
    {
        $user = User::factory()->create([
            'gender' => null,
            'tanggal_lahir' => null,
        ]);

        Sanctum::actingAs($user);

        $response = $this->putJson('/api/profile', [
            'name' => 'Warga Baru',
            'nik' => '3174000000000001',
            'tanggal_lahir' => '2000-01-02',
            'gender' => 'Laki-laki',
            'no_hp' => '08123456789',
            'alamat' => 'Jl. Mawar',
            'rw' => '01',
            'rt' => '02',
        ]);

        $response->assertOk()
            ->assertJson([
                'status' => true,
                'message' => 'Profile berhasil diupdate',
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Warga Baru',
            'nik' => '3174000000000001',
            'tanggal_lahir' => '2000-01-02',
            'gender' => 'Laki-laki',
            'no_hp' => '08123456789',
            'alamat' => 'Jl. Mawar',
            'rw' => '01',
            'rt' => '02',
        ]);
    }
}
