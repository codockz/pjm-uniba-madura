<div id="mainSlider" class="carousel slide" data-ride="carousel" data-interval="4000">

    {{-- INDICATOR --}}
    <ol class="carousel-indicators">
        @foreach($sliders as $key => $slider)
        <li data-target="#mainSlider" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
        @endforeach
    </ol>

    {{-- SLIDES --}}
    <div class="carousel-inner">

        @foreach($sliders as $key => $slider)
        <div class="item {{ $key == 0 ? 'active' : '' }}">

            <div class="slider-wrapper">
                <img src="{{ asset('storage/' . $slider->gambar) }}" class="slider-img">

                <div class="slider-overlay"></div>

                <div class="slider-content">
    <div class="slider-content-inner">
        <h2>{{ $slider->judul }}</h2>
        <p>{{ $slider->deskripsi }}</p>

        @if($slider->link)
        <a href="{{ $slider->link }}" class="btn btn-success">
            SELENGKAPNYA
        </a>
        @endif
    </div>
</div>
            </div>

        </div>
        @endforeach

    </div>

    {{-- CONTROL --}}
    <a class="left carousel-control" href="#mainSlider" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>

    <a class="right carousel-control" href="#mainSlider" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>

</div>
<script>
    $(document).ready(function () {
        $('#mainSlider').carousel({
            interval: 4000,
            pause: false
        });
    });
</script>
