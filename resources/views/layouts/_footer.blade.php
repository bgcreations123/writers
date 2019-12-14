Footer -->
<footer class="page-footer font-small blue-grey lighten-5">

    <div style="background-color: #eee;">
      <div class="container">

        <!-- Grid row-->
        <div class="row py-4 d-flex align-items-center">

          <!-- Grid column -->
          <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
            <h6 class="mb-0">Get connected with us on social networks!</h6>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-6 col-lg-7 text-center text-md-right">

            <!-- Facebook -->
            <a class="fb-ic" href="{{ setting('social-media.facebook') }}"  target="_blank">
              <i class="fab fa-facebook-f white-text mr-4"> </i>
            </a>
            <!-- Twitter -->
            <a class="tw-ic" href="{{ setting('social-media.twitter') }}"  target="_blank">
              <i class="fab fa-twitter white-text mr-4"> </i>
            </a>
            <!-- Google +-->
            <a class="gplus-ic" href="https://mail.google.com/mail/?view=cm&fs=1&to={{ setting('social-media.google') }}"  target="_blank">
              <i class="fab fa-google-plus-g white-text mr-4"> </i>
            </a>
            <!--Linkedin -->
            <a class="li-ic" href="{{ setting('social-media.linkedin') }}"  target="_blank">
              <i class="fab fa-linkedin-in white-text mr-4"> </i>
            </a>
            <!--Instagram-->
            <a class="ins-ic" href="{{ setting('social-media.instagram') }}"  target="_blank">
              <i class="fab fa-instagram white-text"> </i>
            </a>

          </div>
          <!-- Grid column -->

        </div>
        <!-- Grid row-->

      </div>
    </div>

    <!-- Footer Links -->
    <div class="container text-center text-md-left mt-5">

      <!-- Grid row -->
      <div class="row mt-3 dark-grey-text">

        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mb-4">

          <!-- Content -->
          <h6 class="text-uppercase font-weight-bold">{{ setting('site.title') }}</h6>
          <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>{{ setting('site.site_about') }}</p>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

          <!-- Links -->
          <h6 class="text-uppercase font-weight-bold">Products</h6>
          <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>
            <a class="dark-grey-text">{{ setting('products.essay') }}</a>
          </p>
          <p>
            <a class="dark-grey-text">{{ setting('products.speech') }}</a>
          </p>
          <p>
            <a class="dark-grey-text">{{ setting('products.research') }}</a>
          </p>
          <p>
            <a class="dark-grey-text">{{ setting('products.course_work') }}</a>
          </p>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

          <!-- Links -->
          <h6 class="text-uppercase font-weight-bold">Useful links</h6>
          <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>
            <a class="dark-grey-text" href="{{ route('home') }}">Your Account</a>
          </p>
          <p>
            <a class="dark-grey-text" href="#!">Become an Affiliate</a>
          </p>
          <p>
            <a class="dark-grey-text" href="{{ route('home') }}">Shipping Rates</a>
          </p>
          <p>
            <a class="dark-grey-text" href="#!">Help</a>
          </p>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

          <!-- Links -->
          <h6 class="text-uppercase font-weight-bold">Contact</h6>
          <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>
            <i class="fas fa-home mr-3"></i> {{ setting('contacts.address1') }}</p>
          <p>
            <i class="fas fa-envelope mr-3"></i> {{ setting('contacts.email') }}</p>
          <p>
            <i class="fas fa-phone mr-3"></i> {{ setting('contacts.office_number') }}</p>
          <p>
            <i class="fas fa-mobile-alt mr-3"></i> {{ setting('contacts.mobile_number') }}</p>

        </div>
        <!-- Grid column -->

      </div>
      <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center text-black-50 py-3">© 2019 {{-- Copyright: --}}
      {{-- <a class="dark-grey-text" href="https:theokumusempire.com" target="_blank"> http://theokumusempire.com</a> --}}
    </div>
    <!-- Copyright -->

  </footer>
  <!-- Footer