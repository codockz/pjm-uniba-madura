@if (!empty($content_footer))
<footer class="footer-v1">
    <div class="menuFooter clearfix">
      <div class="container">
        <div class="row clearfix">
          <div class="col-sm-4 col-xs-6">
            <ul class="menuLink">
              <li><a href="{{ route('frontend.pengumuman') }}">Pengumuman</a></li>
              <li><a href="{{ route('frontend.berita') }}">Berita</a></li>
              <li><a href="#">Agenda</a></li>
              <li><a href="international_students.html">Foto</a></li>
            </ul>
          </div><!-- col-sm-3 col-xs-6 -->

          <div class="col-sm-4 col-xs-6 borderLeft">
            <div class="footer-address">
              <h5>Location:</h5>
              <address>
               {{ $content_footer->lokasi}}

                </address>
              <a href="{{ $content_footer->g_map}}" target="_blank"><span class="place"><i class="fa fa-map-marker"></i>Main Campus</span></a>
            </div>
          </div><!-- col-sm-3 col-xs-6 -->

          <div class="col-sm-3 col-xs-6 borderLeft">
            <div class="socialArea">
              <h5>Find us on:</h5>
              <ul class="list-inline ">
              <li><a href="{{ $content_footer->facebook }}"><i class="fa fa-facebook"></i></a></li>
              <li><a href="{{ $content_footer->instagram }}"><i class="fa fa-instagram"></i></a></li>
              <li><a href="{{ $content_footer->youtube }}"><i class="fa fa-youtube-play"></i></a></li>
              </ul>
            </div><!-- social -->
            <div class="contactNo">
              <h5>Call us on:</h5>
              <h3>{{ $content_footer->no_telp }}</h3>
            </div><!-- contactNo -->
          </div><!-- col-sm-3 col-xs-6 -->

        </div><!-- row -->
      </div><!-- container -->
    </div><!-- menuFooter -->

    <div class="footer clearfix">
      <div class="container">
        <div class="row clearfix">
          <div class="col-sm-6 col-xs-12 copyRight">
            <p>© 2016 Copyright<a href="https://unibamadura.ac.id/page/"> {{ $content_footer->name }}</a></p>
          </div><!-- col-sm-6 col-xs-12 -->
          <div class="col-sm-6 col-xs-12 privacy_policy">
            <a href="contact-us.html">Contact us</a>
            <a href="privacy-policy.html">Privacy Policy</a>
          </div><!-- col-sm-6 col-xs-12 -->
        </div><!-- row clearfix -->
      </div><!-- container -->
    </div><!-- footer -->
  </footer>
    @else
    <footer class="footer-v1">
        <div class="menuFooter clearfix">
          <div class="container">
            <div class="row clearfix">
              <div class="col-sm-4 col-xs-6">
                <ul class="menuLink">
                    <li><a href="course-fullwidth.html">All Courses</a></li>
                    <li><a href="buying-steps.html">Admission</a></li>
                    <li><a href="photo-gallery3col.html">Photo Gallery</a></li>
                    <li><a href="international_students.html">International Students</a></li>
                </ul>
              </div><!-- col-sm-3 col-xs-6 -->

              <div class="col-sm-4 col-xs-6 borderLeft">
                <div class="footer-address">
                  <h5>Location:</h5>
                  <address>
                    Jl. Raya Lenteng, Aredake, Batuan, Kec. Batuan, Kabupaten Sumenep, Jawa Timur 69451
                    </address>
                  <a href="https://maps.app.goo.gl/pPoT32FMcvP2MqTB8" target="_blank"><span class="place"><i class="fa fa-map-marker"></i>Main Campus</span></a>
                </div>
              </div><!-- col-sm-3 col-xs-6 -->

              <div class="col-sm-3 col-xs-6 borderLeft">
                <div class="socialArea">
                  <h5>Find us on:</h5>
                  <ul class="list-inline ">
                  <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                  <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                  </ul>
                </div><!-- social -->
                <div class="contactNo">
                  <h5>Call us on:</h5>
                  <h3>012-3434-456768</h3>
                </div><!-- contactNo -->
              </div><!-- col-sm-3 col-xs-6 -->

            </div><!-- row -->
          </div><!-- container -->
        </div><!-- menuFooter -->

        <div class="footer clearfix">
          <div class="container">
            <div class="row clearfix">
              <div class="col-sm-6 col-xs-12 copyRight">
                <p>© 2016 Copyright Royal College Bootstrap Template by <a href="http://www.iamabdus.com">Abdus</a></p>
              </div><!-- col-sm-6 col-xs-12 -->
              <div class="col-sm-6 col-xs-12 privacy_policy">
                <a href="contact-us.html">Contact us</a>
                <a href="privacy-policy.html">Privacy Policy</a>
              </div><!-- col-sm-6 col-xs-12 -->
            </div><!-- row clearfix -->
          </div><!-- container -->
        </div><!-- footer -->
      </footer>
@endif

