<!DOCTYPE html>
<html>
	<head>
		@stack('before_styles')
		@include('admin.includes.styles')
		@stack('after_styles')
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			@include('admin.includes.adminheader')
			@include('admin.includes.sidebar')
			<div class="content-wrapper" style="cursor: context-menu;">
			    <!-- Content Header (Page header) -->
			    

			    <!-- Main content -->
			    <section class="content">
					@yield('content')
				</section>
    			<!-- /.content -->
  			</div>
			@include('admin.includes.adminfooter')
		</div>
		@stack('before_scripts')
		@include('admin.includes.requiredjs')
		@stack('after_scripts')
	</body>
</html>