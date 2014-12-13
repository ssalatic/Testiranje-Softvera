@extends('layout')

@section('head')
	
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
	
	</script>

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
		
		#reset_message {
			left:40%;
			top:25%;
		}
    </style>
 @stop

 @section('content')
	
	<div class="row">
		<div id="notifications">
			<div class="alert alert-dismissable alert-info">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Alert</strong>Ubacujte obavjestenja ovdje. Npr. ako se resetuje password. 
			</div>
		</div>
	</div>
    <div class="row">
		<div class="col-sm-3">
			<div class="header"><h4 id="name">Marko Markovic</h4></div>
			<div id="pic">
				<img src="img/user.jpg" width="200" height="200"/>
			</div>
			
			<div class="header"><h4>Select User</h4></div>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#dancer" data-toggle="tab" aria-expanded="true">Dancer</a></li>
				<li class=""><a href="#trainer" data-toggle="tab" aria-expanded="true">Trainer</a></li>
			</ul>
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane fade active in" id="dancer">
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
				
				
				<div class="tab-pane fade" id="trainer">
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
					<td>First name:</td><td><span id="first_name">Marko</span></td>
                </tr>
				<tr>
					<td>Last name:</td><td><span id="last_name">Markovic</span></td>
                </tr>
                <tr>
                    <td>Birth date:</td><td><span id="birth_date">1. 1. 1990.</span></td>
                </tr>
				<tr>
					<td>Social number:</td><td><span id="social_number">12345674890</span></td>
                </tr>
				<tr>
					<td>Phone number:</td><td><span id="phone_number">12345674890</span></td>
                </tr>
				<tr>
					<td>Email:</td><td><span id="email">marko@markovic.com</span></td>
                </tr>
				<tr>
                    <td>User type:</td><td><span id="user_type">Dancer</span></td>
                </tr>
				<tr>
					<td>Gender:</td><td><span id="gener">Male</span></td>
                </tr>
				
				<tr>
					<td>Group:</td><td><span id="group">101</span></td>
                </tr>
				<tr>
					<td>Size:</td>
				</tr>
				<tr>
					<td><span>Shoe</span></td><td><span id="group">45.5</span></td>
				</tr>
				<tr>
					<td><span>Ballet</span></td><td><span id="group">45.5</span></td>
				</tr>
				<tr>
					<td><span> Sneakers</span><td><span id="group">45.5</span></td>
				</tr>
				<tr></tr>
				<tr>
						<td>samo na svom vide<a href = "javascript:void(0)" onclick = "showPopup('reset_message')" class="btn btn-danger btn-xs">Reset password</a></td>
				</tr>
            </table>
		</div>
        <div class="col-sm-3">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Skill level</h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover ">
					<thead>
						<tr>
							<th>Type</th><th>Level</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td>Light jig</td>
						<td>Medium</td>      
					</tr>
					<tr>
						<td>Jig</td>
						<td>Interm.</td>
					</tr>
					<tr>
						<td>Jig</td>
						<td>Begginer</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Costumes</h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover ">
					<thead>
						<tr>
							<th>Costume</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td>Blue small #1</td>     
					</tr>
					<tr>
						<td>Blue small #2</td>
					</tr>
					<tr>
						<td>Blue small #3</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Coreographies</h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover ">
					<thead>
						<tr>
							<th>Coreography</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td>Chor #1</td>     
					</tr>
					<tr>
						<td>Chor #2</td>
					</tr>
					<tr>
						<td>Chor #3</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
        </div>
    </div>
	
@stop
<div id="reset_message" class="white_content">
	<form>
		<label for="old_password" class="control-label">Old password:</label><br>
		<input type="password" id="old_password"  class="form-control"/><br>
		<label for="new_password" class="control-label">New password:</label><br>
		<input type="password" id="new_password" class="form-control" /><br>
		<a href="#" class="btn btn-success btn-xs">Confirm</a>
		<a href = "javascript:void(0)" onclick = "hidePopup('reset_message')" class="btn btn-danger btn-xs">Cancel</a>
	</form>
</div>
 <div id="fade" class="black_overlay"></div>
