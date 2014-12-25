@extends('layout')

@section('head')
<!-- Page specific CSS, JS, and other files in <head> -->
    <!-- CSS -->
        <style>
        body{
            padding-top: 70px;
        }
		
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
		 
		 #add_user{
			display:none;
		 }
		
		#i_group{
			display:block;
		}
		
		 .black_overlay{
			display: none;
			position: absolute;
			top: 0%;
			left: 0%;
			width:100%;
			height:100%;
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
		
		#new_practice {
			left:43%;
			top:20%;
			width:15%;
		}
    </style>

	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<script>
		function showPopup(id)
		{
			document.getElementById(id).style.display='block';
			document.getElementById('fade').style.display='block';
			
			var body = document.body,
						html = document.documentElement;

			var height = Math.max( body.scrollHeight, body.offsetHeight, 
                       html.clientHeight, html.scrollHeight, html.offsetHeight );
					   
			document.getElementById('fade').style.height= height + 'px';
		}
		
		function hidePopup(id)
		{
			document.getElementById(id).style.display='none';
			document.getElementById('fade').style.display='none';
		}
		
		function toogle()
		{
			var tog1 = document.getElementById('add_user').style.display;
			if(tog1 == 'block')
				tog1 = 'none';
			else
				tog1 = 'block';
			document.getElementById('add_user').style.display = tog1;
			
			var tog2 = "";
			if(tog1 == 'block')
				tog2 = 'none';
			else
				tog2 = 'block';
				document.getElementById('i_group').style.display = tog2;
		}
	
	</script>
	
@stop


@section('content')
		<div class="row">
		<div class="col-lg-6">
			<a href = "javascript:void(0)" onclick = "showPopup('new_practice')" class="btn btn-success btn-xs">Add New</a>
			<a href = "javascript:void(0)" onclick ="showPopup('new_practice')" class="btn btn-success btn-xs">Edit</a>
			<a href="#" class="btn btn-danger btn-xs">Delete</a>
		</div>
	</div>
    <div class="row">
		<div class="col-sm-3">
			<div class="header"><h4>Upcoming Practices</h4></div>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#regular" data-toggle="tab" aria-expanded="true">Regular</a></li>
				<li class=""><a href="#personal" data-toggle="tab" aria-expanded="true">Personal</a></li>
			</ul>
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane fade active in" id="regular">
					<form role="search">
						<div class="form-group">
                            <input type="text" placeholder="Search" class="form-control">
                        </div>
                    </form>
					<select class="form-control" multiple="">
						<option>Kvazimodo ooo</option>
						<option>Kvazimodko oooo</option>
					</select>
				</div>
				
				
				<div class="tab-pane fade" id="personal">
					<form role="search">
						<div class="form-group">
                            <input type="text" placeholder="Search" class="form-control">
                        </div>
                    </form>
					<select class="form-control" multiple="">
						<option>Trainer #1</option>
						<option>Trainer #2</option>
					</select>
				</div>
			</div>	
		</div>	
		<div class="col-sm-5">
			<table class="user-info hidden-xs">
				<tr>
					<td>Date:</td><td><span id="p_date">15.09.2014.</span></td>
                </tr>
				<tr>
					<td>Teacher:</td><td><span id="teacher">Marko Markovic</span></td>
                </tr>
                <tr>
                    <td>Group:</td><td><span id="group">101</span></td>
                </tr>
			</table>
			<div class="header"><h4>Dancers</h4></div>
			<table class="table table-striped table-hover ">
				<thead>
					<td> First Name </td><td>Last Name</td>
				</thead>
				<tr>
					<td>Marko</td><td>Markovic</td>
				</tr>
				<tr>			
					<td>Pera</td><td>Peric</td>
				</tr>
				<tr>				
					<td>Random</td><td>Lik</td>
				</tr>
			</table>
		</div>
        <div class="col-sm-3">
			<div id="notifications">
			<div class="alert alert-dismissable alert-info">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Alert</strong>Ubacujte obavjestenja ovdje. Npr. ako se resetuje password. 
			</div>
		</div>
        </div>
    </div>
 <div id="fade" class="black_overlay"></div>
</div>

<div id="new_practice" class="white_content">
	<div class="row">
	<div class="col-sm-12">
			<label for="practice_date">Date:</label><br><input type="date" id="practice_date"><br/>
			<label for="teacher_name">Teacher:</label><br><input type="text" id="teacher_name"><br/>
			<div class="checkbox">
					<label> 
						<input type="checkbox" id="c_personal" onclick="toogle();"><p>Personal</p>
					</label>
			<div id="i_group">
			<label for="group">Group:</label><br><input type="number" id="group"><br/>
			</div>
			</div>
</div>
<div id="add_user">	
	<div class="row">
		<div class="col-sm-12">
			<table class="table table-striped table-hover" style="width:100%;">
				<tr>
					<td>
						<span class="label label-info">User</span>
					</td>
					<td>
						<p>Marko Markovic</p>
					</td>
				</tr>
				<tr>
					<td>
						<span class="label label-info">User</span>
					</td>
					<td>
						<p>Pera Peric</p>
					</td>
				</tr>
				<tr>
					<td><a href="#" class="btn btn-info btn-xs">Add User</a></td>
					<td></td>
					<td></td>
				</tr>
				</table>
			</div>
	</div>
</div>
	<a href="#" class="btn btn-success btn-xs" onclick = "hidePopup('new_practice')">Ok</a>
				<a href = "javascript:void(0)" onclick = "hidePopup('new_practice')" class="btn btn-danger btn-xs">Cancel</a>
		
</div>
@stop