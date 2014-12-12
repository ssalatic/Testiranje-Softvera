<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS files -->
    <link rel="stylesheet" href="styles/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/fontawesome/4.1.0/css/font-awesome.min.css" />

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
        				<a href="/" class="navbar-brand">Dance</a>
        			</div>
        			<div id="navbarCollapse" class="collapse navbar-collapse">
        				<ul class="nav navbar-nav">
        					<li class="active"><a href="/">Home</a></li>
							<li><a href="#">Practices</a></li>
							<li><a href="{{route('concerts.index')}}">Concerts</a></li>
							<li><a href="{{route('users.index')}}">Users</a></li>
							<li><a href="{{route('competitions.index')}}">Competitions</a></li>
							<?php
								if(UserModel::find(Auth::user())->isAdmin() || UserModel::find(Auth::user())->isDesigner()){
									echo '<li><a href="#">Costumes</a></li>';
								}
								if(UserModel::find(Auth::user())->isAdmin() || UserModel::find(Auth::user())->isTrainer()){
									echo '<li><a href="#">Choreographies</a></li>';
								}
								
							?>
							<li><a href="#">Files</a></li>
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
