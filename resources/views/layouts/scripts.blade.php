<!-- =============== VENDOR SCRIPTS ===============-->
<!-- JQUERY-->
<script src="{{ asset('vendor/jquery/dist/jquery.js') }}"></script>
<!-- BOOTSTRAP-->
<script src="{{ asset('vendor/popper.js/dist/popper.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
<!-- STORAGE API-->
<script src="{{ asset('vendor/js-storage/js.storage.js') }}"></script>
<!-- SCREENFULL-->
<script src="{{ asset('vendor/screenfull/dist/screenfull.js') }}"></script>
<!-- =============== PAGE VENDOR SCRIPTS ===============-->
<!-- SLIMSCROLL-->
<script src="{{ asset('vendor/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<!-- MOMENT JS-->
<script src="{{ asset('vendor/moment/min/moment-with-locales.js') }}"></script>
<!-- =============== APP SCRIPTS ===============-->
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.js') }}"></script>

@yield('scripts')
