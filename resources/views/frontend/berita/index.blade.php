@extends('frontend_layouts.app')
@section('content')
    @php
        $monthNames = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];
    @endphp
    <div class="mainContent clearfix">
        <div class="container">
            <div class="course-grid course-3col">
                <div class="about_inner clearfix">

                    <div class="row d-flex flex-wrap">
                        @forelse ($berita as $as)
                            <div class="col-xs-6 col-sm-4 d-flex">

                                <div class="news-card">
                                    <div class="aboutImage">
                                        <a href="{{ route('frontend.showBerita', $as->slug) }}">
                                            <img src="{{ asset('gambar_media') }}/{{ $as->gambar }}"
                                                class="img-responsive" />

                                            <div class="overlay">
                                                <p>{{ Str::limit($as->isi, 150) }}</p>
                                            </div>

                                            <span class="captionLink">Selengkapnya<span></span></span>
                                        </a>
                                    </div>

                                    <h3 class="news-title">
                                        <a href="{{ route('frontend.showBerita', $as->slug) }}">
                                            {{ $as->judul }}
                                        </a>
                                    </h3>
                                </div>

                            </div>
                        @empty
                            <center>
                                <h1 style="padding:50px;">Tidak Ada Berita</h1>
                            </center>
                        @endforelse
                    </div>

                </div><!-- row -->

                {{-- <ul class="pagination">
            <li>
              <a aria-label="Previous" href="#">
              <span aria-hidden="true">Previous</span>
              </a>
            </li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">6</a></li>
            <li><a href="#">...</a></li>
            <li><a href="#">38</a></li>
            <li>
              <a aria-label="Next" href="#">
              <span aria-hidden="true">Next</span>
              </a>
            </li>
          </ul> --}}

            </div><!-- about_inner -->
        </div><!-- course-grid -->
    </div><!-- container -->
    </div><!-- mainContent -->
@endsection
