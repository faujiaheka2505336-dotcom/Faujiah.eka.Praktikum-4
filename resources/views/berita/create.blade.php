@extends('layouts.app')

@section('title', 'Tambah Berita')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="panel">
            <div class="panel-head"><i class="bi bi-plus-circle-fill me-1"></i> Tambah Berita</div>
            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data" class="p-4">
                @csrf
                @include('berita._fields', ['berita' => null])

                <div class="d-flex gap-2 pt-3 border-top">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                    <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
