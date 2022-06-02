@extends('guest.layouts.app')
@section('content')
	@include('guest.includes.register')
@endsection()
@push('after_head')
	<script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>
@endpush()

@push('after_scripts')
	<script>
    var button = document.querySelector('#submit-button');

    braintree.dropin.create({
      authorization: "{{ Braintree_ClientToken::generate() }}",
      container: '#dropin-container'
    }, function (createErr, instance) {
      button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
          $.get('', {payload}, function (response) {
            if (response.success) {
              alert('Payment successfull!');
            } else {
              alert('Payment failed');
            }
          }, 'json');
        });
      });
    });
  </script>
@endpush()