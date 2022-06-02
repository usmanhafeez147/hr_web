@stack('before_scripts')
<!-- Bootstrap core JavaScript -->

<script src="{{asset('/theme_vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Plugin JavaScript -->
<script src="{{asset('/theme_vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for this template -->
<script src="{{asset('js/stylish-portfolio.js')}}"></script>

<script src="{{asset('js/intlTelInput.min.js')}}"></script>

<script>
  $("#phone").intlTelInput({
      //allowDropdown: false,
      //autoHideDialCode: false,
      //autoPlaceholder: "off",
      dropdownContainer: "body",
      //excludeCountries: ["us"],
      formatOnDisplay: false,
      geoIpLookup: function(callback) {
        $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
          var countryCode = (resp && resp.country) ? resp.country : "";
          callback(countryCode);
        });
      },
      //hiddenInput: "full_number",
      initialCountry: "auto",
      nationalMode: false,
      //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      placeholderNumberType: "MOBILE",
      //preferredCountries: ['cn', 'jp'],
      separateDialCode: false,
      utilsScript: "/js/utils.js"
  });
</script>

@stack('after_scripts')
