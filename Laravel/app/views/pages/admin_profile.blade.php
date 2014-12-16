@extends('layout')

@section('head')

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
		
		#new_user {
			left:31%;
			top:15%;
			height:70%;
		}
		
		#reset_message {
			left:40%;
			top:25%;
		}
		
		#dues {
			left:40%;
			top:25%;
		}
    </style>
	
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
		
		function alertselected(selectobj){
				var id = selectobj.options[selectobj.selectedIndex].id;
				alert(id);
		}
		
	
	</script>


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
		<div class="col-lg-6">
			<a href = "javascript:void(0)" onclick = "showPopup('new_user')" class="btn btn-success btn-xs">Add New</a>
			<a href = "javascript:void(0)" onclick ="showPopup('new_user')" class="btn btn-success btn-xs">Edit user</a>
			<a href="#" class="btn btn-danger btn-xs">Delete User</a>
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
				<li class=""><a href="#admin" data-toggle="tab" aria-expanded="true">Admin</a></li>
			</ul>
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane fade active in" id="dancer">
					<form role="search">
						<div class="form-group">
                            <input type="text" placeholder="Search" class="form-control">
                        </div>
                    </form>
					<?php
						//print dancers
						UserModel::getUsers(1);
					?>
				</div>
				
				
				<div class="tab-pane fade" id="trainer">
					<form role="search">
						<div class="form-group">
                            <input type="text" placeholder="Search" class="form-control">
                        </div>
                    </form>
					<?php
						//print trainers
						UserModel::getUsers(1);
					?>
				</div>
				<div class="tab-pane fade" id="admin">
					<form role="search">
						<div class="form-group">
                            <input type="text" placeholder="Search" class="form-control">
                        </div>
                    </form>
					<?php
						//print admins
						UserModel::getUsers(1);
					?>
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
					<td><span> Sneakers</span></td><td><span id="group">45.5</span></td>
				</tr>
				<tr>
					<td>Dues:</td> <td><span>Paid</span></td>
				</tr>
				<tr></tr>
            </table>
			
			<table  class="user-info hidden-xs">
			
				<tr>
						<td> ovo vidi na svom <a href = "javascript:void(0)" onclick = "showPopup('reset_message')" class="btn btn-danger btn-xs">Reset password</a></td>
				</tr>
				<tr>
						<td> ovo vidi na ostalim<a href = "javascript:void(0)" onclick = "showPopup('dues')" class="btn btn-danger btn-xs">Dues</a></td>
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
	
 <div id="fade" class="black_overlay"></div>

<div id="new_user" class="white_content">
	<div class="row">
	<div class="col-sm-6">
			<div class="header"><h4 id="name">Marko Markovic</h4></div>
			<div id="pic">
				<img src="img/user.jpg" width="200" height="200"/>
			</div>
			<label for="user_type">User type:</label>
			<div class="btn-toolbar">
				<div class="btn-group" id="user_type">
					<a href="#" class="btn btn-primary btn-xs">Dancer</a>
					<a href="#" class="btn btn-primary btn-xs">Trainer</a>
					<a href="#" class="btn btn-primary btn-xs">Admin</a>
				</div>
			</div>
			<label for="gender">Gender:</label>
			<div class="btn-toolbar">
				<div class="btn-group">
					<a href="#" class="btn btn-primary btn-xs">Male</a>
					<a href="#" class="btn btn-primary btn-xs">Female</a>
				</div>
			</div>
			<label for="shoe_size">Shoe size:</label><br><input type="number" id="shoe_size"><br/>
			<label for="ballet_size">Ballet size:</label><br><input type="number" id="ballet_size"><br/>
			<label for="sneakers_size">Sneakers size:</label><br><input type="number" id="sneakers_size">
		</div>
		<div class="col-sm-6">
			<label for="first_name">First name:</label><br>
			<input type="text" id="first_name" class="form-control"/><br>
			<label for="last_name">Last name:</label><br>
			<input type="text" id="last_name" class="form-control"/><br>
			<label for="birth_date">Date of birth:</label><br>
			<input type="date" id="birth_date" class="form-control"/><br>
			<label for="social_number">Social number:</label><br>
			<input type="text" id="social_number" class="form-control"/><br>		
			<label for="social_number">Phone number:</label><br>
			<input type="text" id="phone_number" class="form-control"/><br>
			<label for="email">Email:</label><br>
			<input type="email" id="email" class="form-control"/><br>
			<label for="group">Group:</label>
			<select class="form-control" id="group">
				<option>101</option>
				<option>102</option>
			</select>
			<br><br><br>
			<a href="#" class="btn btn-success btn-xs">Save User</a>
			<a href = "javascript:void(0)" onclick = "hidePopup('new_user')" class="btn btn-danger btn-xs">Cancel</a>
		</div>
</div></div>
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

<div id="dues" class="white_content">
	<form>
		<label for="old_password" class="control-label">Date:</label><br>
		<input type="date" id="date"  class="form-control"/><br>
		<label for="new_password" class="control-label">Amount:</label><br>
		<input type="password" id="new_password" class="form-control" /><br>
		<a href="#" class="btn btn-success btn-xs">Confirm</a>
		<a href = "javascript:void(0)" onclick = "hidePopup('dues')" class="btn btn-danger btn-xs">Cancel</a>
	</form>
 
</div>
@stop