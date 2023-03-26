      <!-- Footer -->
      <footer>
          <div class="col-12 d-flex justify-content-around footer-social">
              <a href=""><img src="public/image/facebook.svg" alt=""> Facebook</a>
              <a href=""><img src="public/image/youtube.svg" alt=""> Youtube</a>
              <a href=""><img src="public/image/twitter.svg" alt=""> Twitter</a>
          </div>
          <div class="row">
              <div class="col-6 col-lg-4 order-lg-2">
                  <ul class="footer-ul">
                      <li><a href="{{ url('/about-us') }}">About Us</a></li>
                      <li><a href="{{ url('/privacy') }}">Privacy</a></li>
                      <li><a href="{{ url('/term-of-service') }}">Term Of Service</a></li>
                  </ul>
              </div>
              <div class="col-6 col-lg-4 order-lg-3">
                  <ul class="footer-ul">
                      <li><a href="{{ url('/movies') }}">Movies</a></li>
                      <li><a href="{{ url('/series') }}">Series</a></li>
                      <li><a href="{{ url('/news') }}">News</a></li>
                      <li><a href="{{ url('/stars') }}">Stars</a></li>
                  </ul>
              </div>
              <div class="col-12 col-lg-4 order-lg-1">
                  <a class="footer-logo" href="{{ url('/') }}"><img class="w-80" src="{{ asset('image/logo.png') }}" alt=""></a>
              </div>
          </div>
          <div class="span-footer d-flex justify-content-center">
              <span>Copyright ™ XeNews. All rights reserved.</span>
          </div>
      </footer>


      <!-- End Footer -->
