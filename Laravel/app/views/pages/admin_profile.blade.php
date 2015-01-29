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
		
		
		function doSomething(id, usern, name, lname, bdate, pnumber, eemail,esssize,ebssize,essize,eheight, eutype, egender)
		{
			/* ovo radi treba fizicki radnik da popuni */
			var username = document.getElementById("edit_username");
			username.value = usern;
			var first_name = document.getElementById("edit_first_name");
			first_name.value = name;
			var last_name = document.getElementById("edit_last_name");
			last_name.value = lname;
			var birth_date = document.getElementById("edit_birth_date");
			birth_date.value = bdate;
			var phone_number = document.getElementById("edit_phone_number");
			phone_number.value = pnumber;
			var email = document.getElementById("edit_email");
			email.value = eemail;
			
			var shoe_size = document.getElementById("edit_shoe_size");
			shoe_size.value = esssize;
			var ballet_shoe_size = document.getElementById("edit_ballet_shoe_size");
			ballet_shoe_size.value = ebssize;
			var sneakers_size = document.getElementById("edit_sneakers_size");
			sneakers_size.value = essize;
			var edit_height = document.getElementById("edit_height");
			edit_height.value = eheight;
			
			if(egender == 'male') document.getElementById('edit_male').checked = true;
			else document.getElementById('edit_female').checked = true;
			

			
			
			showPopup(id);
		
		}
		
		
	</script>


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
		<div class="col-lg-6">
			<a href = "javascript:void(0)" onclick = "showPopup('new_user')" class="btn btn-success btn-xs">Add New</a>
			<?php	echo '<a href = "javascript:void(0)" onclick ="doSomething(\'edit_user\',\''.$user->username.'\'
					,\''.$user->first_name.'\',\''.$user->last_name.'\',\''.$user->birth_date.'\'
					,\''.$user->phone_number.'\',\''.$user->email.'\'
					,\''.$user->shoe_size.'\',\''.$user->ballet_shoe_size.'\',\''.$user->sneakers_size.'\',\''.$user->height.'\'
					,\''.$user->user_type.'\',\''.$user->sex.'\'
					)" class="btn btn-success btn-xs">Edit user</a>'; 
					
					//echo '<a href = "javascript:void(0)" onclick = "deleteThisUser(\''.$user->id.'\')" class="btn btn-danger btn-xs">Delete</a>';
			?>
			
			{{ Form::open(['method' => 'DELETE', 'onSubmit' => 'return confirm("You sure??");', 'route' => ['users.destroy', $user->id]]) }}

			{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) }}

			{{ Form::close() }}
			
		</div>
	</div>
    <div class="row">
		<div class="col-sm-3">
			<div class="header"><h4 id="name">Username: <?php echo $user->username; ?></h4></div>
			
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
				<tr>
					<td>Dues:</td> <td><span>
							<?php
								$dues = PaymentModel::where('user_id','=',$user->id)->first();
								if(count($dues) != 0){
									$date = new DateTime($dues->date_payed);
									echo $date->format('d.m.Y').' - '.$dues->amount.' din';
								}

							?>
						</span></td>
				</tr>
				<tr></tr>
            </table>
			
			<table  class="user-info hidden-xs">
				<tr></tr>
				<tr>
						<td><a href = "javascript:void(0)" onclick = "showPopup('reset_message')" class="btn btn-danger btn-xs">Reset password</a></td>
						<td><a href = "javascript:void(0)" onclick = "showPopup('dues')" class="btn btn-danger btn-xs">Dues</a></td>
				</tr>
				<!--<tr>
						<td><a href = "javascript:void(0)" onclick = "showPopup('dues')" class="btn btn-danger btn-xs">Dues</a></td>
				</tr>-->
			
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
						/*$costumes = $user->hasCostumes();
						foreach($costumes as $costume){
						
							echo '<tr>
								<td>'.$costume->id.'</td>     
								</tr>';
						
						}*/
						
						
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
	
 <div id="fade" class="black_overlay"></div>
 
 
<!-------------------------------------------------------------------------->
 <div id="edit_user" class="white_content">
 
 
 {{ Form::open(['method' => 'PUT', 'class'=>"form-horizontal", 'route' => ['users.update', $user->id]]) }}
<!--<form id="registrationForm" method="POST" class="form-horizontal" action="{{ URL::route('users.store') }}">-->
	<div class="row">
	<div class="col-sm-6">
			<!--<div class="header"><h4 id="name">Enter information</h4></div>-->
			
			<label for="usernam">Username:</label><br>
			<input type="text" id="edit_username" name="username" class="form-control" readonly/><br>

			<label for="user_type">User type:</label>
			<div class="btn-toolbar">
				<div class="btn-group1" id="user_type">
					<div class="col-sm-5">

							<div class="checkbox">
								<label>
									<?php
										if($user->isDancer())
										echo '<input id = "dancer" name="dancer"  type="checkbox" checked/>Dancer';
										else echo '<input id = "dancer" name="dancer"  type="checkbox" />Dancer';
									?>
								</label>
							</div>
							<div class="checkbox">
								<label>
								<?php
									if($user->isDesigner())
										echo '<input id = "dancer" name="designer"  type="checkbox" checked/>Designer';
									else echo '<input id = "dancer" name="designer"  type="checkbox" />Designer';
								?></label>
							</div>
							<div class="checkbox">
								<label>
								<?php
								if($user->isTrainer())
									echo '<input id = "dancer" name="trainer"  type="checkbox" checked/>Trainer';
								else echo '<input id = "dancer" name="trainer"  type="checkbox" />Trainer';
								?></label>
							</div>
							<div class="checkbox">
								<label>
								<?php
								if($user->isAdmin())
									echo '<input id = "dancer" name="admin"  type="checkbox" checked/>Admin';
								else echo '<input id = "dancer" name="admin"  type="checkbox" />Admin';
								?>
									</label>
							</div>
						</div>
			<!--		<a href="#" class="btn btn-primary btn-xs">Dancer</a>
					<a href="#" class="btn btn-primary btn-xs">Trainer</a>
					<a href="#" class="btn btn-primary btn-xs">Admin</a> -->
				</div>
			</div>
			<label for="gender">Gender:</label>
			<div class="btn-toolbar">
				<div class="btn-group">
				<div class="radio" id="gender">
                                <label>
                                    <input type="radio" name="gender" id="edit_male" value="male" /> Male
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" id="edit_female" value="female" /> Female
                                </label>
                            </div>
				<!--
					<a href="#" class="btn btn-primary btn-xs">Male</a>
					<a href="#" class="btn btn-primary btn-xs">Female</a> -->
				</div>
			</div>
			<label for="shoe_size">Shoe size:</label><br><input type="number" id="edit_shoe_size" name="shoe_size"><br/>
			<label for="ballet_shoe_size">Ballet size:</label><br><input type="number" id="edit_ballet_shoe_size" name="ballet_shoe_size"><br/>
			<label for="sneakers_size">Sneakers size:</label><br><input type="number" id="edit_sneakers_size" name="sneakers_size">
			<label for="height">Height:</label><br><input type="number" id="edit_height" name="height" />
		</div>
			
		<div class="col-sm-6">
			<label for="first_name">First name:</label><br>
			<input type="text" id="edit_first_name" name="first_name" class="form-control"/><br>
			<label for="last_name">Last name:</label><br>
			<input type="text" id="edit_last_name" name="last_name" class="form-control"/><br>
			<label for="birth_date">Date of birth:</label><br>
			<input type="date" id="edit_birth_date" name="birth_date" class="form-control"/><br>
			<label for="social_number">Phone number:</label><br>
			<input type="text" id="edit_phone_number" name="phone_number" class="form-control"/><br>
			<label for="email">Email:</label><br>
			<input type="email" id="edit_email" name="email" class="form-control"/><br>
			<label for="group">Group:</label>
			<?php
				$groups = GroupModel::all(); //DB::table('user')->where('user_type', $userType)->get();

				echo '<select name="groups[]" class="form-control" id="group" multiple size = "3">';

				foreach($groups as $group){
				if($user->inGroup($group->id))
					echo '<option selected value="'.$group->id.'">'.$group->name.'</option>';
				else
					echo '<option value="'.$group->id.'">'.$group->name.'</option>';
				}

				echo '</select>';
			?>
			<br><br><br>
			<div class="form-group">
                        <div> <!-- FRAME STYLE -->
                            {{ Form::token() }}
                        </div>
                    </div>
			<div class="form-group">
                 <!-- Do NOT use name="submit" or id="submit" for the Submit button -->
                 <button type="submit" class="btn btn-success btn-xs">Update</button>
				 <a href = "javascript:void(0)" onclick = "hidePopup('edit_user')" class="btn btn-danger btn-xs">Cancel</a>
            </div>
			<!--</form>-->{{ Form::close() }}

			
		</div>
</div></div>
 
<!-----------------------------------------------------------------------------------------------------------------------------> 

<div id="new_user" class="white_content">
<form id="registrationForm" method="POST" class="form-horizontal" action="{{ URL::route('users.store') }}">
	<div class="row">
	<div class="col-sm-6">
			<!--<div class="header"><h4 id="name">Enter information</h4></div>-->
			
			<label for="usernam">Username:</label><br>
			<input type="text" id="username" name="username" class="form-control"/><br>
		

			<label for="user_type">User type:</label>
			<div class="btn-toolbar">
				<div class="btn-group1" id="user_type">
					<div class="col-sm-5">

						<div class="checkbox">
							<label>
								<input name="dancer"  type="checkbox" />Dancer
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input name="designer"  type="checkbox" />Designer
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input name="trainer"  type="checkbox" />Trainer
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input name="admin"  type="checkbox" />Admin
							</label>
						</div>
					</div>
			<!--		<a href="#" class="btn btn-primary btn-xs">Dancer</a>
					<a href="#" class="btn btn-primary btn-xs">Trainer</a>
					<a href="#" class="btn btn-primary btn-xs">Admin</a> -->
				</div>
			</div>
			<label for="gender">Gender:</label>
			<div class="btn-toolbar">
				<div class="btn-group">
				<div class="radio">
                                <label>
                                    <input type="radio" name="gender" value="male" /> Male
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" value="female" /> Female
                                </label>
                            </div>
				<!--
					<a href="#" class="btn btn-primary btn-xs">Male</a>
					<a href="#" class="btn btn-primary btn-xs">Female</a> -->
				</div>
			</div>
			<label for="shoe_size">Shoe size:</label><br><input type="number" id="shoe_size" name="shoe_size"><br/>
			<label for="ballet_shoe_size">Ballet size:</label><br><input type="number" id="ballet_shoe_size" name="ballet_shoe_size"><br/>
			<label for="sneakers_size">Sneakers size:</label><br><input type="number" id="sneakers_size" name="sneakers_size">
			<label for="height">Height:</label><br><input type="number" id="height" name="height" />
		</div>
			
		<div class="col-sm-6">
			<label for="first_name">Password:</label><br>
			<input type="text" id="password" name="password" class="form-control"/><br>
			<label for="first_name">First name:</label><br>
			<input type="text" id="first_name" name="first_name" class="form-control"/><br>
			<label for="last_name">Last name:</label><br>
			<input type="text" id="last_name" name="last_name" class="form-control"/><br>
			<label for="birth_date">Date of birth:</label><br>
			<input type="date" id="birth_date" name="birth_date" class="form-control"/><br>
			<label for="social_number">Phone number:</label><br>
			<input type="text" id="phone_number" name="phone_number" class="form-control"/><br>
			<label for="email">Email:</label><br>
			<input type="email" id="email" name="email" class="form-control"/><br>
			<label for="group">Group:</label>
			<?php GroupModel::getGroups(); ?>
			<br><br><br>
			<div class="form-group">
                        <div> <!-- FRAME STYLE -->
                            {{ Form::token() }}
                        </div>
                    </div>
			<div class="form-group">
                 <!-- Do NOT use name="submit" or id="submit" for the Submit button -->
                 <button type="submit" class="btn btn-success btn-xs">Sign up</button>
				 <a href = "javascript:void(0)" onclick = "hidePopup('new_user')" class="btn btn-danger btn-xs">Cancel</a>
            </div>
			</form>
			
		</div>
</div></div>
<!----------------------------------------------------------------------------------------------------------------------------->
<div id="reset_message" class="white_content">
	{{ Form::open(['method' => 'PUT', 'route' => ['password.new', $user->id]]) }}
		<label for="old_password" class="control-label">Old password:</label><br>
		<input type="password" id="old_password" name="old_password"  class="form-control"/><br>
		<label for="new_password" class="control-label">New password:</label><br>
		<input type="password" id="new_password" name="new_password" class="form-control" /><br>
	{{ Form::token() }}
		<div class="form-group">
			<!-- Do NOT use name="submit" or id="submit" for the Submit button -->
			<button type="submit" class="btn btn-success btn-xs">Confirm</button>
			<a href = "javascript:void(0)" onclick = "hidePopup('reset_message')" class="btn btn-danger btn-xs">Cancel</a>
		</div>
	{{ Form::close() }}
 
</div>

<div id="dues" class="white_content">
	{{ Form::open(['method' => 'PUT', 'route' => ['update.dues', $user->id]]) }}
		<label for="old_password" class="control-label">Date:</label><br>
		<input type="date" id="date" name = "date"  class="form-control"/><br>
		<label for="new_password" class="control-label">Amount:</label><br>
		<input type="text" id="new_password" name = "amount" class="form-control" /><br>
		<div class="form-group">
			<!-- Do NOT use name="submit" or id="submit" for the Submit button -->
			<button type="submit" class="btn btn-success btn-xs">Confirm</button>
			<a href = "javascript:void(0)" onclick = "hidePopup('dues')" class="btn btn-danger btn-xs">Cancel</a>
		</div>
	{{ Form::close() }}
 
</div>
@stop