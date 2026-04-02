@extends('frontend_layouts.app')

@section('content')
<div class="container">
    <h1>{{ $title ?? 'Sistem Penjaminan Mutu' }}</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('frontend.frontend') }}">Beranda</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ $breadcrumb ?? 'Sistem Penjaminan Mutu' }}
            </li>
        </ol>
    </nav>

    <p>
        Halaman ini berisi informasi terkait {{ strtolower($title ?? 'sistem penjaminan mutu') }}.
        Konten akan diperbarui.
    </p>
</div>
@endsection
