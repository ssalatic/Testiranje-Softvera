@extends('layout')

@section('head')
<!-- Page specific CSS, JS, and other files in <head> -->
    <!-- CSS -->
    <style>
        /* Zaglavlja iznad panela */
        .header{
            font-style: italic;
            font-weight: bold;
        }
       
		.user-info{
            width:80%;
            font-weight: bold;
            font-size: 12pt;
        }
		.user-info td{
			height:40px;
		}
		
		.user-info td span{
            font-weight: normal;
            font-style: italic;
            margin: 10px;
        }
		
		option{
			height:40px;
		}
			
		thead {
			background-color: rgb(200, 200, 200);
		 }
		 
		  .black_overlay{
		display: none;
	position: absolute;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 120%;
	background-color: black;
	z-index:1001;
	-moz-opacity: 0.8;
	opacity:.80;
	filter: alpha(opacity=80);
}

.white_content {
	display: none;
	border-radius: 25px;
	position: absolute;
	top: 25%;
	left: 25%;
	width: 50%;
	height: 50%;
	padding: 16px;
	border: 16px solid gray;
	background-color: white;
	z-index:1002;
	overflow: auto;
}
    </style>
	
@stop


@section('content')

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
                    <a href="#" class="navbar-brand">Dance</a>
                </div>
                <div id="navbarCollapse" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/">Home</a></li>
                        <li><a href="{{route('competitions.index')}}">Competitions</a></li>
						<li><a href="{{route('concerts.index')}}">Concerts</a></li>
						<li><a href="{{route('profile.index')}}">Profile</a></li>
						<li class="active"><a href="{{route('profile.index')}}">Files</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ route('logout') }}">Log out</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
	
	<div class="row">

        <div class="col-sm-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Pictures</h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover ">
					<tbody>
					<tr>
						<td>Picture1</td>
					</tr>
					<tr>
						<td>Picture2</td>
					</tr>
					<tr>
						<td>Picture3</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Videos</h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover ">
					<tbody>
					<tr>
						<td>Video1</td>     
					</tr>
					<tr>
						<td>Video2</td>
					</tr>
					<tr>
						<td>Video3</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Files</h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover ">
					<tbody>
					<tr>
						<td>PDF1</td>     
					</tr>
					<tr>
						<td>PDF2</td>
					</tr>
					<tr>
						<td>PDF3</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
        </div>
    </div>
	
@stop