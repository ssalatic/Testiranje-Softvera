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
		
		function alertselected(selectobj){
			var id = selectobj.options[selectobj.selectedIndex].id;
			alert(id);
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
		
		#about_message {
			left:40%;
			top: 25%;
		}
    </style>

 @stop

 @section('content')

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
		<div class="col-sm-3">
			<div class="header"><h4 id="name">Username: <?php echo $user->username; ?></h4></div>
			<br/><br/>
			
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
			</div>	

		<br/><br/>

	<?php

			$last0 = TrainingModel::where( DB::raw('MONTH(date)'), '=', date('n'))->where('trainer_id', '=', $user->id)->get();
			$last1 = TrainingModel::where( DB::raw('MONTH(date)-1'), '=', date('n'))->where('trainer_id', '=', $user->id)->get();
			$last2 = TrainingModel::where( DB::raw('MONTH(date)-2'), '=', date('n'))->where('trainer_id', '=', $user->id)->get();
			$last3 = TrainingModel::where( DB::raw('MONTH(date)-3'), '=', date('n'))->where('trainer_id', '=', $user->id)->get();

			$a = new DateTime();

				if($user->isTrainer())
			echo '<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Efficiency</h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover ">
					<thead>
						<tr>
							<th>Month</th><th>Trainings</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td>'.$a->format('F').'</td>
						<td>'.count($last0).'</td>
					</tr>
					<tr>
						<td>'.$a->modify('-1 month')->format('F').'</td>
						<td>'.count($last1).'</td>
					</tr>
					<tr>
						<td>'.$a->modify('-1 month')->format('F').'</td>
						<td>'.count($last2).'</td>
					</tr>
					<tr>
						<td>'.$a->modify('-1 month')->format('F').'</td>
						<td>'.count($last3).'</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>';
	?>
			
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
				<table class="user-info hidden-xs">

					<tr>
						<td>About:</td>
					</tr>
					<tr>
						<td><span ><?php echo $user->about; ?></span></td>
					</tr>
				<tr>
						<!--<td><textarea type="text" id="about" class="text-control"></textarea>About</td> -->
						<td></td>
						<td><a href = "javascript:void(0)" onclick = "showPopup('about_message')" class="btn btn-danger btn-xs">Edit</a></td>
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

<div id="about_message" class="white_content">
	{{ Form::open(['method' => 'PUT', 'route' => ['update.about', $user->id]]) }}
		<label for="old_password" class="control-label">About</label><br/>
		<textarea rows="6" class="form-control" name = "text" style="resize:none;"><?php echo $user->about; ?></textarea><br/>
		<div class="form-group">
			<!-- Do NOT use name="submit" or id="submit" for the Submit button -->
			<button type="submit" class="btn btn-success btn-xs">Confirm</button>
			<a href = "javascript:void(0)" onclick = "hidePopup('about_message')" class="btn btn-danger btn-xs">Cancel</a>
		</div>
	{{ Form::close() }}
 
</div>

 <div id="fade" class="black_overlay"></div>
