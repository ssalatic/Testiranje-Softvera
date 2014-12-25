<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS files -->
    {{ HTML::style('styles/bootstrap.css'); }}
    {{ HTML::style('https://cdn.jsdelivr.net/fontawesome/4.1.0/css/font-awesome.min.css'); }}

    <style>
        /* Potrebno da menu ne bi zaklanjao sadrzaj jer je fixed-menu */
        body{
            padding-top: 70px;
        }
    </style>

    <!-- JS files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- Page specific CSS, JS, and other files in <head> -->
    @yield('head')
	
	<?php
		//MenuModel::updateMenu(Route::currentRouteName(), Auth::user());
								
								
	?>
	
  </head>
  
  <body>
    <div class="container">
        <div class="row">
            <nav role="navigation" class="navbar navbar-default navbar-fixed-top">
        	    <div class="container-fluid">
        			<div class="navbar-header">
        				<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
        					<span class="sr-only">Toggle navigation</span>
        					<span class="icon-bar"></span>
       						<span class="icon-bar"></span>
        					<span class="icon-bar"></span>
        				</button>
        				<a href="{{route('index')}}" class="navbar-brand">Dance</a>
        			</div>
        			<div id="navbarCollapse" class="collapse navbar-collapse">
        				<ul class="nav navbar-nav">
        					<!--<li class="active"><a href="{{route('index')}}">Home</a></li>
							<li><a href="{{route('trainings.show')}}">Practices</a></li>
								
							<li><a href="{{route('concerts.show')}}">Concerts</a></li>
							<li><a href="{{route('users.show')}}">Users</a></li>
							<li><a href="{{route('competitions.show')}}">Competitions</a></li>-->
							<?php
							MenuModel::updateMenu(Route::currentRouteName(), Auth::user());
								/*if(Auth::user()->isAdmin() || Auth::user()->isDesigner()){
									echo '<li><a href="#">Costumes</a></li>';
								}
								if(Auth::user()->isAdmin() || Auth::user()->isTrainer()){
									echo '<li><a href="#">Choreographies</a></li>';
								}*/
							?>
							<!--<li><a href="{{route('gallery')}}">Files</a></li>-->
        				</ul>
        				<ul class="nav navbar-nav navbar-right">
        					<li><a href="{{ route('logout') }}">Log out</a></li>
        				</ul>
        			</div>
        		</div>
        	</nav>
        </div>

        @yield('content')

    </div>
  </body>

</html>
