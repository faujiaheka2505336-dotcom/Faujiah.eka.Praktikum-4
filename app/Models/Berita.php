<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Berita extends Model
{
    /** Kategori persis seperti dropdown di jalatrang.id/berita (urut abjad). */
    public const KATEGORI = [
        'ekonomi', 'keuangan', 'kunjungan', 'Olahraga', 'pembangunan',
        'pemuda', 'Pendidikan', 'potensi', 'Prestasi dan Apresiasi',
        'tidak memiliki kategori',
    ];

    public const PLACEHOLDER = 'https://placehold.co/800x450/0f3460/ffffff?text=Berita+Desa';

    protected $fillable = [
        'judul', 'kategori', 'gambar', 'isi', 'tags',
        'penulis', 'dilihat', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Berita::filter($request->only('q', 'kategori', 'tag'))
     * Semua filter opsional; yang kosong diabaikan oleh when().
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['q'] ?? null, fn ($q, $kata) => $q->where('judul', 'like', "%{$kata}%"))
            ->when($filters['kategori'] ?? null, fn ($q, $kategori) => $q->where('kategori', $kategori))
            // tags disimpan "a,b,c" -> FIND_IN_SET cocok persis per tag (MySQL)
            ->when($filters['tag'] ?? null, fn ($q, $tag) => $q->whereRaw('FIND_IN_SET(?, tags)', [$tag]));
    }

    /** Gambar bisa berupa URL penuh (seeder) atau path upload di disk "public". */
    public function getGambarUrlAttribute(): string
    {
        if (! $this->gambar) {
            return self::PLACEHOLDER;
        }

        if (Str::startsWith($this->gambar, ['http://', 'https://'])) {
            return $this->gambar;
        }

        return Storage::disk('public')->exists($this->gambar)
            ? asset('storage/' . $this->gambar)
            : self::PLACEHOLDER;
    }

    /** $berita->tag_list -> ['voli', 'bola', 'turnamen'] */
    public function getTagListAttribute(): array
    {
        return array_values(array_filter(explode(',', (string) $this->tags)));
    }

    /** Hapus file gambar hanya bila hasil upload lokal (bukan URL eksternal). */
    public function deleteLocalImage(): void
    {
        if ($this->gambar && ! Str::startsWith($this->gambar, ['http://', 'https://'])) {
            Storage::disk('public')->delete($this->gambar);
        }
    }
}
