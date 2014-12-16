@extends('layout')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="styles/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/fontawesome/4.1.0/css/font-awesome.min.css" />

    <style>
        body{
            padding-top: 70px;
        }
		 .header{
            font-style: italic;
            font-weight: bold;
        }
		
        .comp-info{
            width:80%;
            font-weight: bold;
            font-size: 12pt;
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
		
        .comp-info td span{
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
		 
		.label{
			white-space: nowrap;
			text-overflow: ellipsis;
			display: block;
			overflow: hidden
		}
		
		.black_overlay{
			display: none;
			position: absolute;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 100%;
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
			padding: 16px;
			border: 12px solid orange;
			background-color: white;
			z-index:1002;
			overflow: auto;
		}
	
		#new_concert_1{
			left:12%;
			top: 15%;
		}
	
		#new_ticket{
			left:40%;
			top:20%;
		}
	
		#new_concert_2{
			left:12%;
			top: 15%;
		}
	
		#save {
			left:40%;
			top: 25%;
		}
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<script>
		function showPopup(id)
		{
			document.getElementById(id).style.display='block';
			document.getElementById('fade').style.display='block';
		}
		
		function hidePopup(id)
		{
			document.getElementById(id).style.display='none';
			document.getElementById('fade').style.display='none';
		}
	
	</script>
 @stop

 @section('content')
	<?php
	if(Auth::user()->isAdmin())
	echo '<div class="row">
			<div class="col-lg-6">
				<a href = "javascript:void(0)" onclick = "showPopup(\'new_concert_1\')" class="btn btn-success btn-xs">Add New</a>
			</div>
	</div>';
	?>
    <div class="row">
		<div class="col-sm-4">
			<div class="header"><h4>Select concerts</h4></div>
					<form role="search">
						<div class="form-group">
                            <input type="text" placeholder="Search" class="form-control">
                        </div>
                    </form>
					<select class="form-control" multiple="">
						<option>Grand Masters</option>
						<option>Random name</option>
					</select>
			
		</div>
		<div class="col-sm-4">
		
			<div class="header"><h4>Neko ime</h4></div>
			
			
			
			<table class="user-info hidden-xs">
				<tr>
					<td>Date:</td><td><span id="first_name">15.10.2014.</span></td>
                </tr>
				<tr>
					<td>Location:</td><td><span id="last_name">Belgrade</span></td>
                </tr>
                <tr>
                    <td>Judges:</td><td><span id="birth_date">Will Smith</span></td>
                </tr>
				<tr>
					<td>Musician:</td><td><span id="social_number">Madonna</span></td>
                </tr>
            </table>
			
			
            <div class="header"><h4>Files</h4></div>
            <table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Type</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td><a href="#">Opening ceremony</a></td>
                    <td><span class="label label-success">Video</span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><a href="#">Photos</a></td>
                    <td><span class="label label-danger">Photo</span></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td><a href="#">Coreography</a></td>
                    <td><span class="label label-info">PDF</span></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-4">
            <div class="header"><h4>Participants</h4></div>
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Opening Act</h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover ">
					<thead>
						<tr>
							<th>Name</th><th>Costume</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>John Boo</td>
						<td>Black dress #1</td>      
					</tr>
					<tr>
						<td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>Michael Robinson</td>
						<td>Black dress #1</td>
					</tr>
					<tr>
						<td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>Alexander Robson</td>
						<td>Red dress #1</td>
					</tr>
					<tr>
						<td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>Jannifer Pinkser</td>
						<td>Red dress #2</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
            
        </div>
    </div>
@stop
<div id="new_concert_1" class="white_content container">
	<div class="row">
	<div class="col-sm-4">
		<label for="name">Name</label><br/>
		<input id="name" type="text" class="form-control input-sm" />
		<label for="date">Date</label><br/>
		<input id="date" type="date" class="form-control input-sm" />
		<label for="location">Location</label><br/>
		<input id="location" type="text" class="form-control input-sm" /><br/>
		<div class="header">
				<div class="col-sm-12 col-sm-offset-9"><a href = "javascript:void(0)" onclick = "hidePopup('new_concert_1');showPopup('new_ticket')" class="btn btn-info btn-xs">Add Ticket</a></div>
		</div>
            <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Balcony</td>
                        <td>200</td>
                        <td>100.0</td>
                    </tr>
                    <tr>
                        <td>VIP</td>
                        <td>50</td>
                        <td>500.0</td>
                    </tr>
                    <tr>
                        <td>Front</td>
                        <td>100</td>
                        <td>800.0</td>
                    </tr>
                </tbody>
            </table>
	</div>
	<div class="col-sm-4">
		<div class="header"><h4>Coreographies</h4></div>
				<form role="search">
					<div class="form-group">
                         <input type="text" placeholder="Search" class="form-control">
                    </div>
                </form>
				<select class="form-control" multiple="">
					<option>Grand Masters</option>
					<option>Random name</option>
				</select>
	</div>
	<div class="col-sm-4">
		<div class="header"><h4>Saved concerts</h4></div>
				<form role="search">
					<div class="form-group">
                         <input type="text" placeholder="Search" class="form-control">
                    </div>
                </form>
				<select class="form-control" multiple="">
					<option>Concert #1</option>
					<option>Concert #2</option>
				</select>
	</div>
	</div>
	<a onclick = "hidePopup('new_concert_1'); showPopup('new_concert_2')" class="btn btn-success btn-xs">Next</a>
	<a href = "javascript:void(0)" onclick = "hidePopup('new_concert_1')" class="btn btn-danger btn-xs">Cancel</a>
</div>
<div id="new_concert_2" class="white_content container">
	<div class="row">
	<div class="col-sm-4">
	<div class="header"><h4>Coreographies</h4></div>
				<form role="search">
					<div class="form-group">
                         <input type="text" placeholder="Search" class="form-control">
                    </div>
                </form>
				<select class="form-control" multiple="">
					<option>Coreography 1</option>
					<option>Coreography 2</option>
				</select>
		</div>
        <div class="col-sm-4">
			<div class="header"><h4>Select Dancers</h4></div>
				<form role="search">
					<div class="form-group">
                         <input type="text" placeholder="Search" class="form-control">
                    </div>
                </form>
				<select class="form-control" multiple="">
					<option>Dancer #1</option>
					<option>Random name</option>
				</select>
		</div>
		  <div class="col-sm-4">
			<div class="header"><h4>Red Costumes</h4></div>
				<form role="search">
					<div class="form-group">
                         <input type="text" placeholder="Search" class="form-control">
                    </div>
                </form>
				<select class="form-control" multiple="">
					<option>Red Small #1</option>
					<option>Random name</option>
				</select>
		</div>
	</div>
	<a href = "javascript:void(0)" onclick = "hidePopup('new_concert_2')" class="btn btn-success btn-xs">Complete</a>
	<a href = "javascript:void(0)" onclick = "hidePopup('new_concert_2'); showPopup('save')" class="btn btn-danger btn-xs">Save</a>
</div>
<div id="new_ticket" class="white_content">
	<label for="name">Name</label><br/>
	<input type="text" class="form-control input-sm" id="name" />
	<label for="amount">Amount</label><br/>
	<input type="text" class="form-control input.sm" id="amount" />
	<label for="price">Price</label><br/>
	<input type="text" class="form-control input-sm" id="price" /><br/>
	<a href="#" class="btn btn-success btn-xs">Complete</a>
	<a href = "javascript:void(0)" onclick = "hidePopup('new_ticket'); showPopup('new_concert_1')" class="btn btn-danger btn-xs">Cancel</a>
</div>
<div id="save" class="white_content">
	<div class="header"><h4>Enter a name for this version</h4></div>
	<input type="text" id="conc_name" placeholder="Name for this version..." /><br/>
	<a href="#" class="btn btn-success btn-xs">Save</a>
	<a href = "javascript:void(0)" onclick = "hidePopup('save'); showPopup('new_concert_2')" class="btn btn-danger btn-xs">Cancel</a>
</div>
<div id="fade" class="black_overlay"></div>
