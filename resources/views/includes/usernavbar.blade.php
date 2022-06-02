<nav class="navbar navbar-findcond navbar-fixed-top">
    <div class="container">
		<img src="https://lh3.googleusercontent.com/8BhbMuvnYckjUaSCyxqtFx41xg11ISEIAZKoUDl80osp7QZi6yeSevJ_QOubcC16iZw=w300" class="pull-left" style="height:35px;width:35px;margin-top:5px"
				 /> 
		<div class="navbar-header">
			<button id="colaps-btn" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			
			<a style="width:121px"  class="navbar-brand" href="">Crash Quiz</a>
		
			<ul  class="nav navbar-nav navbar-right">
		
		</ul>
		
			
		</div>
		
		<div class="collapse navbar-collapse pull-left" id="navbar">
			 
				
				
				 
				 	<ul  class="nav navbar-nav navbar-right">
		<li class="active"><a href="">Trending<span class="sr-only">(current)</span></a></li>
						
						<li class="active"><a href="">Featured<span class="sr-only">(current)</span></a></li>
						<div class="content-to-hide" id="sm-screen-log-btn">
			
		<ul class="nav navbar-nav navbar-right">
		<li  class="dropdown">
                                <a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    name <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href=""
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
		</ul>
		
		
		</div>
		
		</ul>
		
				
			
			<form action="" method="get" class="navbar-form navbar-right search-form" role="search">
				<input name="q" id="q" type="text" value="" class="form-control" placeholder="Search" />
			</form>
			
        </div>
		<div class="content-to-hide" id="log-btn">
			@if(!Auth::check())
				
				   <ul class="nav navbar-nav navbar-right">
						
		  			<li class="active"><a href="">Login<span class="sr-only">(current)</span></a></li>
		</ul>
		@else
		<ul class="nav navbar-nav navbar-right">
		<li  class="dropdown">
                                <a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                   name <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href=""
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
		</ul>
				@endif
		
		</div>
		
    </div>
</nav>

