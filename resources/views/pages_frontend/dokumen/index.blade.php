@extends('frontend_layouts.app')
@section('content')


@if ($data->isEmpty())
@else
<center><h1>{{ $title }}</h1></center>
@endif


<div class="mainContent clearfix">
  <div class="container">
      <div class="course-grid">
          <div class="about_inner clearfix">
              <div class="row">
                  @forelse ($data as $x)
                  @if($x->publish_dokumen == 1)
                      <div class="col-xs-6 col-sm-3">
                            <img src="{{ asset('thumbnail_dokumen') }}/{{ $x->thumbnail }}" alt="{{ $title }}" width="150">
                            <br>
                          @if($x->download_dokumen == 1)
                          <span>
                              <a href="{{ asset('file_dokumen') }}/{{ $x->dokumen }}" target="_blank" style="color:black !important;">{{ $x->nama_dokumen }}</a>
                          </span>
                          @else
                          <span>
                           {{ $x->nama_dokumen }}
                          </span>
                          @endif
                      </div>
                      @endif
                  @empty
                      <center><h1 style="padding: 100px;">Tidak Ada Dokumen</h1></center>
                  @endforelse
              </div><!-- row -->
          </div>
      </div>
  </div>
</div>

@endsection
