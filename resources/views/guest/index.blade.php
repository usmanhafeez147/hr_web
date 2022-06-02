@extends('guest.layouts.app')    
@section('content')

  @include('guest.includes.about')

  @include('guest.includes.services')


  
  <!-- 'guest.includes.portfolio' -->

  <!-- 'guest.includes.register' -->



@endsection()

@push('after_head')
	<style type="text/css">
		/* centered columns styles */
		.row-centered {
		    text-align:center;
		}
		.col-centered {
		    display:inline-block;
		    float:none;
		    /* reset the text-align */
		    text-align:left;
		    /* inline-block space fix */
		    margin-right:-4px;
		    text-align: center;
		}
	</style>
@endpush()