@extends('guest.layouts.app')
@section('content')
    <div class="container content-section">
        <form id="example-form" method="post" action="{{route('location_save')}}">
            {{csrf_field()}}
            <div>
                <h3>Set Your Location</h3>
                <section>
                    @include('guest.steps.location')
                </section>
                <h3>Invite Employee</h3>
                <section>
                    @include('guest.steps.user')
                </section>
                <h3>Times and Rules</h3>
                <section>
                    @include('guest.steps.settings')
                </section>


            </div>
        </form>
    </div>
@endsection()

@push('after_scripts')
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcoySGITCj_1UwWejhlrQqRmzOC8WeVHU&callback=initMap&libraries=places" async defer></script>

    <script>
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: -34.397, lng: 150.644},
              zoom: 8
            });
            
            var marker=new google.maps.Marker({
              position:{
                lat: -34.397, 
                lng: 150.644
              },
              map:map,
              draggable: true

            });
            
            var searchBox= new google.maps.places.SearchBox(document.getElementById('searchmap'));

            google.maps.event.addListener(searchBox,'places_changed',function() {
              var places= searchBox.getPlaces();
              var bounds= new google.maps.LatLngBounds();
              var i,place;
              for(i=0;place=places[i];i++)
              {
                bounds.extend(place.geometry.location);
                marker.setPosition(place.geometry.location);
              }
              map.fitBounds(bounds);
              map.setZoom(15);
              //map.setCenter(marker.getPosition());
            });
        
            google.maps.event.addListener(marker,'position_changed',function(){
              var lat=marker.getPosition().lat();
              var lng= marker.getPosition().lng();


              $('#lat').val(lat);
              $('#lng').val(lng);

            });
        }
    </script>
    <script>
        var form = $("#example-form");
        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
            rules: {
                confirm: {
                    equalTo: "#password"
                }
            }
        });
        form.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            onStepChanging: function (event, currentIndex, newIndex)
            {
                $('.wizard .content').animate({ height: $('.body.current').outerHeight() }, "slow");

                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinishing: function (event, currentIndex)
            {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function (event, currentIndex)
            {
              form.submit();
            }
        });


    </script>

@endpush()