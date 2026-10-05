<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public function index(Request $request): View
    {
        $beritas = Berita::query()
            ->filter($request->only('q', 'kategori', 'tag'))
            ->latest('published_at')
            ->paginate(6)
            ->withQueryString();

        return view('berita.index', compact('beritas'));
    }

    public function create(): View
    {
        return view('berita.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function show(Berita $berita): View
    {
        $berita->increment('dilihat');

        // Sidebar "Berita Terkait": berita lain, terbaru dulu.
        $terkait = Berita::where('id', '!=', $berita->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('berita.show', compact('berita', 'terkait'));
    }

    public function edit(Berita $berita): View
    {
        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama agar storage tidak menumpuk file yatim.
            $berita->deleteLocalImage();
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('berita.show', $berita)
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(Berita $berita): RedirectResponse
    {
        $berita->deleteLocalImage();

        $berita->delete();

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    /** Validasi + normalisasi input yang dipakai bersama oleh store() dan update(). */
    private function validated(Request $request): array
    {
        $data = $request->validate([
            'judul'        => 'required|max:255',
            'kategori'     => ['required', Rule::in(Berita::KATEGORI)],
            'isi'          => 'required|min:10',
            'tags'         => 'nullable|string|max:255',
            'penulis'      => 'nullable|string|max:100',
            'published_at' => 'nullable|date',
            'gambar'       => 'nullable|image|max:2048', // maks 2 MB
        ]);

        $data['penulis']      = $data['penulis'] ?? 'Admin';
        $data['published_at'] = $data['published_at'] ?? now();
        $data['tags']         = $this->normalizeTags($data['tags'] ?? null);

        // Tanpa upload baru, jangan timpa kolom gambar dengan null saat update.
        unset($data['gambar']);

        return $data;
    }

    /** "#Voli, bola ,Turnamen Voli" -> "voli,bola,turnamen-voli" */
    private function normalizeTags(?string $tags): ?string
    {
        $hasil = collect(explode(',', (string) $tags))
            ->map(fn ($t) => Str::slug(ltrim(trim($t), '#')))
            ->filter()
            ->unique()
            ->implode(',');

        return $hasil !== '' ? $hasil : null;
    }
}
