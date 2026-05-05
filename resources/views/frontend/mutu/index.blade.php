@extends('frontend_layouts.app')

@section('content')
    <div class="container page-content">

        <h3 class="mb-4 text-center fw-bold">
            Sistem Informasi Mutu
        </h3>

        <table id="tableSIM" class="table table-hover table-bordered align-middle text-center">

            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Sistem</th>
                    <th>Singkatan</th>
                </tr>
            </thead>

            <tbody>
    @foreach ($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>

            <td class="text-start">
                {{ $item->nama_penyelenggara }}
            </td>

            <td>
                @if ($item->link)
                    <a href="{{ $item->link }}" target="_blank">
                        {{ $item->singkatan }}
                    </a>
                @else
                    {{ $item->singkatan }}
                @endif
            </td>
        </tr>
    @endforeach
</tbody>

        </table>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            initFrontendDataTable('#tableSIM');
        });
        

    </script>
@endpush
