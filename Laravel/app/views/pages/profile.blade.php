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

		#edit_user {
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



@stop

@section('content')

	<!--<div class="row">
		<div id="notifications">
			<div class="alert alert-dismissable alert-info">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Alert</strong>Ubacujte obavjestenja ovdje. Npr. ako se resetuje password. 
			</div>
		</div>
	</div>-->


	<?php
	if($errors->any())
		echo 	'<div class="row">
					<div id="notifications">
					<div class="alert alert-dismissable alert-info">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Alert</strong>'."   ".$errors->first().'</div>
					</div>
					</div>';
	?>


	<div class="row">
	</div>
	<div class="row">
		<div class="col-sm-3">
			<div class="header"><h4 id="name">Username: <?php echo $user->username; ?></h4></div>
			<br/><br/>
			<div class="header"><h4>Select User</h4></div>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#dancer" data-toggle="tab" aria-expanded="true">Dancer</a></li>
				<li class=""><a href="#trainer" data-toggle="tab" aria-expanded="true">Trainer</a></li>
				<li class=""><a href="#admin" data-toggle="tab" aria-expanded="true">Design</a></li>
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
					UserModel::getUsers(3);
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
					//print designers
					UserModel::getUsers(2);
					?>
				</div>
			</div>
		</div>
		<div class="col-sm-5">
			<table id = "table" class="user-info hidden-xs">
				<tr>
					<td>First name:</td><td><span id="first_name"> <?php echo $user->first_name; ?></span></td>
				</tr>
				<tr>
					<td>Last name:</td><td><span id="last_name"><?php echo $user->last_name; ?></span></td>
				</tr>
				<tr>
					<td>Birth date:</td><td><span id="birth_date"><?php echo $user->birth_date; ?></span></td>
				</tr>
				<tr>
					<td>Phone number:</td><td><span id="phone_number"><?php echo $user->phone_number; ?></span></td>
				</tr>
				<tr>
					<td>Email:</td><td><span id="email"><?php echo $user->email; ?></span></td>
				</tr>
				<tr>
					<td>User type:</td><td><span id="user_type"><?php UserModel::printUserType($user->user_type); ?></span></td>
				</tr>
				<tr>
					<td>Gender:</td><td><span id="gener"><?php echo $user->sex; ?></span></td>
				</tr>

				<tr>
					<td>Group(s):</td>
				</tr>
				<?php $groups = $user->groups;
				foreach($groups as $group){
					echo '<tr><td></td><td><span id="group">'.$group->name.'</span></td></tr>';
				}
				?>

				<tr>
					<td>Size:</td>
				</tr>
				<tr>
					<td><span>Shoe</span></td><td><span id="group"><?php echo $user->shoe_size; ?></span></td>
				</tr>
				<tr>
					<td><span>Ballet</span></td><td><span id="group"><?php echo $user->ballet_shoe_size; ?></span></td>
				</tr>
				<tr>
					<td><span> Sneakers</span><td><span id="group"><?php echo $user->sneakers_size; ?></span></td>
				</tr>
				<tr></tr>
				<tr></tr>
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

						<?php

						/*OVO NECE DA RADI!*/
						$costumes = $user->costumes;
						foreach($costumes as $costume){
						
							echo '<tr>
								<td>'.$costume->identifier.'</td>
								</tr>';
						
						}


						?>
						<!--<tr>
                            <td>Blue small #1</td>
                        </tr>
                        <tr>
                            <td>Blue small #2</td>
                        </tr>
                        <tr>
                            <td>Blue small #3</td>
                        </tr>-->
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

						<?php
						$coreographies = $user->choreographys();
						foreach($coreographies as $coreography){

						echo '<tr>
								<td>'.$coreography->name.'</td>     
								</tr>';

						}


						?>
						<!--<tr>
                            <td>Chor #1</td>
                        </tr>
                        <tr>
                            <td>Chor #2</td>
                        </tr>
                        <tr>
                            <td>Chor #3</td>
                        </tr>-->
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>



@stop