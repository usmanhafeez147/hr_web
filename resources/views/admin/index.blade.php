@extends('admin.includes.app')

@section('content')

   <section class="content-header">

      <div style="color: black; font-size: 25px;font-family: sans-serif;font-weight: 700;text-align: left;margin">Welcome Admin <br>You Look Awesome!</div>
    </section>

  <div id="myDiv" style="margin-top: 80px">  </div>

@endsection()

@push('after_scripts')
		
	<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

	<script type="text/javascript">


 	    var trace1 = {
		  x:<?= json_encode($graphData['x']); ?>,
		  y:<?= json_encode($graphData['y']); ?>, 
		  type: 'scatter'
		};
		
		var data = [trace1];
		Plotly.newPlot('myDiv', data);

	 </script>
@endpush()
