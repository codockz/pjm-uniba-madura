@extends('frontend_layouts.app')

@section('content')
    <div class="container page-content">

        <h3 class="mb-4 text-center fw-bold">
            Survei untuk Pemangku Kepentingan
        </h3>

        <table id="tableSurvei" class="table table-hover table-bordered align-middle text-center">

            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Pengisi</th>
                    <th>Survei Kepuasan Pemangku Kepentingan</th>
                    <th>Survei Evaluasi dan Pemahaman Visi Misi Tujuan dan Strategi</th>
                </tr>
            </thead>

            <tbody>
    @foreach ($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>

            <td>{{ $item->pengisi }}</td>

            <td>
                @if ($item->link_kepuasan)
                    <a href="{{ $item->link_kepuasan }}" target="_blank">
                        {{ $item->kepuasan_text ?? 'Survei Kepuasan ' . $item->pengisi }}
                    </a>
                @else
                    -
                @endif
            </td>

            <td>
                @if ($item->link_evaluasi)
                    <a href="{{ $item->link_evaluasi }}" target="_blank">
                        {{ $item->evaluasi_text ?? 'Survei Evaluasi dan Pemahaman Visi, Misi, Tujuan, dan Strategi' }}
                    </a>
                @else
                    -
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
            initFrontendDataTable('#tableSurvei');
        });
    </script>
@endpush
