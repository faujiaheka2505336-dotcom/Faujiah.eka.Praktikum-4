<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    private const GAMBAR = 'https://jalatrang.id/assets/images/web_berita/';

    public function run(): void
    {
        // updateOrCreate -> aman dijalankan berulang (tidak membuat data ganda)
        Berita::updateOrCreate(
            ['judul' => 'Malam Penuh Gengsi Dimulai! 16 Tim Berebut Mahkota Juara di Ajang CVC Cup 2026 Desa Jalatrang'],
            [
                'kategori'     => 'Olahraga',
                'gambar'       => self::GAMBAR . '1790662317-whatsapp-image-2026-09-27-at-081321.jpeg',
                // TODO: tempel isi lengkap dari halaman detail website (sekarang baru kalimat pembuka).
                'isi'          => <<<'TXT'
JalatrangNews; Himpunan Pemuda-Pemudi Dusun Cikandung yang tergabung dalam Cikandung Voli...
TXT,
                'tags'         => 'cikandung,dusun,2026',
                'dilihat'      => 425,
                'penulis'      => 'Dadi Haryadi',
                'published_at' => '2026-09-26 08:00:00',
            ]
        );

        Berita::updateOrCreate(
            ['judul' => 'Pemerintah Desa Jalatrang Kukuhkan Desa Siaga TB, Perkuat Kolaborasi Lintas Sektor Basmi Tuberkulosis'],
            [
                'kategori'     => 'Pendidikan',
                'gambar'       => self::GAMBAR . '1790660451-whatsapp-image-2026-09-28-at-102755.jpeg',
                // TODO: tempel isi lengkap dari halaman detail website (sekarang baru kalimat pembuka).
                'isi'          => <<<'TXT'
JalatrangNews; Pemerintah Desa Jalatrang, Kecamatan Cipaku, Kabupaten Ciamis, menunjukkan...
TXT,
                'tags'         => 'desa,jalatrang,siaga',
                'dilihat'      => 173,
                'penulis'      => 'Dadi Haryadi',
                'published_at' => '2026-09-28 08:00:00',
            ]
        );
    }
}
