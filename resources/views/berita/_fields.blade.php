{{-- Field form bersama. $berita = null saat create, model saat edit. --}}
<div class="mb-3">
    <label for="judul" class="form-label fw-semibold">Judul</label>
    <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror"
           value="{{ old('judul', $berita?->judul) }}" placeholder="Judul berita...">
    @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="kategori" class="form-label fw-semibold">Kategori</label>
        <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror">
            <option value="">-- Pilih Kategori --</option>
            @foreach (\App\Models\Berita::KATEGORI as $k)
                <option value="{{ $k }}" @selected(old('kategori', $berita?->kategori) == $k)>{{ $k }}</option>
            @endforeach
        </select>
        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="penulis" class="form-label fw-semibold">Penulis</label>
        <input type="text" name="penulis" id="penulis" class="form-control @error('penulis') is-invalid @enderror"
               value="{{ old('penulis', $berita?->penulis ?? 'Admin') }}">
        @error('penulis') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="tags" class="form-label fw-semibold">Tag</label>
        <input type="text" name="tags" id="tags" class="form-control @error('tags') is-invalid @enderror"
               value="{{ old('tags', $berita?->tags) }}" placeholder="voli, bola, turnamen">
        <div class="form-text">Pisahkan dengan koma.</div>
        @error('tags') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="published_at" class="form-label fw-semibold">Tanggal Terbit</label>
        <input type="datetime-local" name="published_at" id="published_at"
               class="form-control @error('published_at') is-invalid @enderror"
               value="{{ old('published_at', $berita?->published_at?->format('Y-m-d\TH:i')) }}">
        <div class="form-text">Kosongkan untuk memakai waktu sekarang.</div>
        @error('published_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="mb-3">
    <label for="gambar" class="form-label fw-semibold">Gambar</label>
    @if ($berita?->gambar)
        <div class="mb-2"><img src="{{ $berita->gambar_url }}" alt="" style="height:90px;border-radius:8px;object-fit:cover"></div>
    @endif
    <input type="file" name="gambar" id="gambar" accept="image/*"
           class="form-control @error('gambar') is-invalid @enderror">
    <div class="form-text">JPG/PNG/WebP, maksimal 2 MB.{{ $berita?->gambar ? ' Kosongkan jika tidak ingin mengganti.' : '' }}</div>
    @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="isi" class="form-label fw-semibold">Isi Berita</label>
    <textarea name="isi" id="isi" rows="8" class="form-control @error('isi') is-invalid @enderror"
              placeholder="Tulis isi berita di sini...">{{ old('isi', $berita?->isi) }}</textarea>
    @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
