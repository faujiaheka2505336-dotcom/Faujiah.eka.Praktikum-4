@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="panel">
            <div class="panel-head"><i class="bi bi-pencil-square me-1"></i> Edit Berita</div>
            <form action="{{ route('berita.update', $berita) }}" method="POST" enctype="multipart/form-data" class="p-4">
                @csrf
                @method('PUT')
                @include('berita._fields', ['berita' => $berita])

                <small class="text-muted d-block mb-3">
                    <i class="bi bi-eye"></i> Dilihat {{ $berita->dilihat }} kali •
                    Terakhir diubah {{ $berita->updated_at->diffForHumans() }}
                </small>

                <div class="d-flex gap-2 pt-3 border-top">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
                    <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
