@extends('frontend_layouts.app')
@section('content')


@if ($data->isEmpty())
@else
<center><h1>Dokumen SOP/POS</h1></center>
@endif


<div class="mainContent clearfix">
    <div class="container">
      <div class="course-grid">
        <div class="about_inner clearfix">
          <div class="row">

            @forelse ($data as $x)
            <div class="col-xs-6 col-sm-3">
                @auth
                    <iframe src="{{ route('view-pdf', $x->dokumen) }}" width="100%" height="300">
                        This browser does not support PDFs. Please download the PDF to view it: <a href="{{ asset('folder/file_name.pdf') }}">Download PDF</a>
                    </iframe>
                @else
                    <a href="{{ route('view-pdf', $x->dokumen) }}" target="_blank">View PDF</a>
                @endauth
                <span>
                    <a href="{{ asset('file_dokumen') }}/{{ $x->dokumen }}" target="_blank" style="color:black !important;">{{ $x->nama_dokumen }}</a>
                </span>
            </div>
        @empty
            <center><h1 style="padding: 100px;">Tidak Ada Dokumen</h1></center>
        @endforelse

        </div><!-- row -->
        </div>
      </div>
    </div>
</div>


@endsection
