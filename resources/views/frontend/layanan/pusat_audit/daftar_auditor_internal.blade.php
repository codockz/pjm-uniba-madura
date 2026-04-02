@extends('frontend_layouts.app')

@section('content')
    <div class="container page-content">

        <h3 class="mb-4 text-center fw-bold">
            Daftar Nama Auditor Internal UNIBA Madura
        </h3>

        <table id="tableAuditor" class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Auditor</th>
                    <th>Fakultas / Lembaga</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->fakultas }}</td>
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

            initFrontendDataTable('#tableAuditor');

        });
    </script>
@endpush
