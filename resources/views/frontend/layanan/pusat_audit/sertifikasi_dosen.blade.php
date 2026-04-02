@extends('frontend_layouts.app')

@section('content')
    <div class="container page-content">

        <h3 class="mb-3 fw-bold">Sertifikasi Dosen</h3>


        {{-- PEDOMAN --}}
        <div class="mb-4">

            <h6 class="fw-bold">PEDOMAN SERTIFIKASI DOSEN</h6>

            <div class="mb-2">
                <a href="#" target="_blank">
                    Buku I Naskah Akademik dan Manajemen Pelaksanaan Sertifikasi Dosen (2019)
                </a>
            </div>

            <div class="mb-2">
                <a href="#" target="_blank">
                    Buku II Buku Pedoman Sertifikasi Dosen (2021)
                </a>
            </div>

            <div class="mb-2">
                <a href="#" target="_blank">
                    Buku III Panduan Penyusunan Portofolio (2019)
                </a>
            </div>

            <div class="mb-2">
                <a href="#" target="_blank">
                    Buku IV Panduan Calon Peserta Sertifikasi Dosen Online PTKI (2019)
                </a>
            </div>

            <p class="mt-2">
                Catatan: Syarat menjadi peserta serdos tahun 2019
            </p>

        </div>


        {{-- TABEL --}}
        <table id="tableSertifikasi" class="table table-bordered table-striped">

            <thead>

                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Tahun Kelulusan</th>
                    <th>Surat Keputusan</th>
                </tr>

            </thead>

            <tbody>

                @forelse ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $item->file) }}" target="_blank">
                                Sertifikasi Tahun {{ $item->tahun }}
                            </a>
                        </td>
                        <td>
                            {{ $item->judul }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            Data tidak ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            initFrontendDataTable('#tableSertifikasi');

        });
    </script>
@endpush
