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

		#new_practice, #edit_practice {
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

	<script>

            $(document).ready(function() {
                $('select[name=type1]').change(function(event) {

                    window.open($('select[name=type1] option:selected').val(),"_self")

                });
            });

	</script>

@stop


@section('content')

		<div class="row">
        @foreach($errors->all() as $message)
            <li>{{ $message }}</li>
        @endforeach

        @if((Auth::user()->isAdmin() || Auth::user()->isTrainer() ) && $training != null)

            <div class="col-lg-6">
                            <a href = "javascript:void(0)" onclick = "showPopup('new_practice')" class="btn btn-success btn-xs">Add New</a>
                            <a href = "javascript:void(0)" onclick ="showPopup('edit_practice')" class="btn btn-success btn-xs">Edit</a>
			{{ Form::open(['method' => 'DELETE', 'onSubmit' => 'return confirm("You sure??");', 'route' => ['trainings.destroy', $training->id]]) }}

			{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) }}

			{{ Form::close() }}

            </div>
        @else
             <div class="col-lg-6">
                 <a href = "javascript:void(0)" onclick = "showPopup('new_practice')" class="btn btn-success btn-xs">Add New</a>
            </div>
        @endif


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
					<select class="form-control" multiple="" onchange="location=this.options[this.selectedIndex].value" size = "3" >
						<?php
							$trainings = TrainingController::getVisibleTrainings();
							foreach($trainings as $tr){
								if($tr->group_id != null){
									$training_date = new DateTime($tr->date);
									echo '<option  value ="'.route('trainings.update',$tr->id).'"> Group: '.GroupModel::find($tr->group_id)->name.' ('.$training_date->format('d F').')</option>';
								}
							}
						
						?>
						<!--
						<option>Kvazimodo ooo</option>
						<option>Kvazimodko oooo</option>
						-->
					</select>
				</div>
				
				
				<div class="tab-pane fade" id="personal">
					<form role="search">
						<div class="form-group">
                            <input type="text" placeholder="Search" class="form-control">
                        </div>
                    </form>
					<select class="form-control" multiple="" onchange="location=this.options[this.selectedIndex].value" size = "3" >
						<?php
							$trainings = TrainingController::getVisibleTrainings();
							foreach($trainings as $tr){
								
								if($tr->group_id == null){
									$training_date = new DateTime($tr->date);
									echo '<option  value ="'.route('trainings.update',$tr->id).'"> Trainer(s): ';
									$counter = 0;
									foreach($tr->trainers as $trainer){
										echo $trainer->first_name; 
										if($counter < count($tr->trainers)-1)
											echo ',';
										$counter++;
									}
									echo '('.$training_date->format('d F').')</option>';
								}
							}
							
						?>
					</select>
				</div>
			</div>	
		</div>
		<div class="col-sm-5">
			<table class="user-info hidden-xs">
				<tr>
					<td>Date:</td><td><span id="p_date"><?php if($training != null) echo (new DateTime($training->date))->format('d F y');  ?></span></td>		
				</tr>
				<tr>
					<td>Time:</td>
					<td><span id="time">
					<?php 
							if($training != null)
								 echo (new DateTime($training->date))->format('H:i');
					?>
					</span></td>	
				</tr>
				<tr>
					<td>Duration:</td><td><span id="duration">
						<?php 
							if($training != null && $training->duration != 0){
								$hours = (int)($training->duration / 60);
								$minutes = $training->duration - $hours*60;
								
								echo $hours.':'.$minutes;
							}
						?>
					</span></td>
				</tr>
				<tr>
					<td>Teacher(s):</td><td>
					<?php 
						$counter = 0;
						if($training!=null)
						foreach($training->trainers as $trainer){
							?><a href="{{route('users.show',$trainer->id)}}"><span id="teacher">
							<?php
							if($training != null && $trainer != null) 
								echo $trainer->first_name .' '. $trainer->last_name. '</span></a>';
							if( $counter < count($training->trainers)-1)
								echo ',';
							$counter++;
						}
					?>
					</td>
				</tr>
                <tr>
                    <td>Group:</td><td><span id="group"><?php if($training != null && GroupModel::find($training->group_id) != null){ echo GroupModel::find($training->group_id)->name;} ?></span></td>
                </tr>
			</table>
			<div class="header"><h4>Dancers</h4></div>
			<table class="table table-striped table-hover ">
				<thead>
					<td> First Name </td><td>Last Name</td><td></td>
				</thead>
			<?php
            if($users != null)
			foreach($users as $user){
                echo'
                    <tr>
                        <td>'.$user->first_name.'</td><td>'.$user->last_name.'</td><td><a href="'.route('users.show', $user->id).'" class="btn btn-success btn-xs">Profile </a></td>
                    </tr>

                    ';
				}
		    ?>
			</table>
		</div>
        <?php /*<div class="col-sm-3">

			<div id="notifications">
			<div class="alert alert-dismissable alert-info">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Alert</strong>Ubacujte obavjestenja ovdje. Npr. ako se resetuje password.
			</div>
		</div>
        </div>
    </div>
 */?>
 <div id="fade" class="black_overlay"></div>
</div>

<div id="new_practice" class="white_content" style="width: intrinsic;" >

	<div class="row">
	<div class="col-sm-12">


            <form id="Form_Edit" method="POST" class="row" action="{{ URL::route('trainings.store') }}" style="margin: 15px;">
			
			<input type="hidden" name="id" value="<?php if($training != null) echo $training->id;?>" />
			
			<table>
		

            <tr>
            <td><label for="practice_date">Date:</label><br><input type="date" name="practice_date"><br/>

            <label for="time">Time:</label><br>
			<label for="hours" class="control-label"> Hours:</label>
					<input type="number" name="time_hours" min="0" max="59"/>
					<br>
					<label for="minutes" class="control-label">Minutes:</label>
					<input type="number" name="time_minutes" min="0" max="59"/>
			<br>
			<label for="duration" class="control-label">Duration</label><br>
					<label for="hours" class="control-label"> Hours:</label>
					<input type="number" name="hours" min="0" max="59"/>
					<br>
					<label for="minutes" class="control-label">Minutes:</label>
					<input type="number" name="minutes" min="0" max="59"/>
					<br>
					<div class="checkbox">
					<label>
						<input name="personal"  type="checkbox" />Personal
					</label>
					</div>
					<div class="checkbox">
						<label>
							<input name="repeated"  type="checkbox" />Repeated
						</label>
					</div>
					<label for="minutes" class="control-label">Number of weeks:</label>
					<input type="number" name="weeks" min="0" max="100"/>
					<br>
			<div class="row"></div>
			<label >Teacher:</label></br>
                    <div class="btn-group" style="margin-bottom: 20px; clear: both;">
                                <select size="3" name="trainers[]" class="form-control" style="margin-left: 10px;" multiple>
                                            <?php

                                                foreach(UserModel::where('user_type', '=', 1)->get() as $trainer){
                                                   if($trainer != null)
                                                   echo '
                                                      <option value = "'.$trainer->id.'">'.$trainer->first_name.' '.$trainer->last_name.'</option>

                                                    ';
                                                }
                                            ?>

                                </select>

                            </div>
                            <div class="row"></div>
							<div class="checkbox">
			<div class="btn-group" style="margin-bottom: 20px; clear: both;">
			            <label >Groups:</label></br>
                        <select size="3" name="groups[]" class="form-control" style="margin-left: 10px;" multiple>
                           <?php
                           foreach(GroupModel::all() as $group){
                                if($group != null)
									echo '<option value = "'.$group->id.'"> '.$group->name.' </option>';
                           }
                           ?>
                        </select>

                    </div>
                    </td>
                    <td>
						<label >Dancers:</label></br>
                        <select name="users[]" class="form-control" style="margin-left: 10px;" multiple>
                           <?php
                           foreach(UserModel::all() as $usr){
                                if($usr != null)
                                echo '<option value = "'.$usr->id.'"> '.$usr->first_name.'  '.$usr->last_name.' </option>';
                           }
                           ?>
                        </select>

                    </td>
                    </tr>
            </table>
                    {{ Form::token() }}
                    <div style="margin-top: 10px; clear: both;">

                        <button type="submit" class="btn btn-success btn-xs" onclick ="hidePopup('new_practice')">Ok</button>

                        <a href = "javascript:void(0)" onclick = "hidePopup('new_practice')" class="btn btn-danger btn-xs">Cancel</a>
                    </div>

                    </form>
			</div>
			

</div>


</div>



<div id="edit_practice" class="white_content" style="width: intrinsic" >

	<div class="row">
	    <div class="col-sm-12">
            @if($training != null)
            {{ Form::open(['method' => 'PUT', 'style' => "margin: 15px;", 'class'=>"row", 'route' => ['trainings.update', $training->id]]) }}

                        <table>

                        <tr>
                        <td><label for="practice_date">Date:</label><br><input type="date" name="practice_date" value="<?php if($training != null) echo explode(" ", $training->date)[0];?>"><br/>
						<label for="time">Time:</label><br>
						<label for="hours" class="control-label"> Hours:</label>
								<input type="number" name="time_hours" min="0" max="59" value="<?php echo (new DateTime($training->date))->format('H') ?>"/>
								<br>
								<label for="minutes" class="control-label">Minutes:</label>
								<input type="number" name="time_minutes" min="0" max="59" value="<?php echo (new DateTime($training->date))->format('i') ?>"/>
						<br>
						<label for="duration" class="control-label">Duration</label><br>
								<label for="hours" class="control-label"> Hours:</label>
								<input type="number" name="hours" min="0" max="59" value="<?php echo (int)($training->duration/60) ?>"/>
								<br>
								<label for="minutes" class="control-label">Minutes:</label>
								<input type="number" name="minutes" min="0" max="59" value="<?php echo (int)($training->duration%60) ?>"/>
								<br>
                        <div class="row"></div>
            			<label >Teacher:</label></br>
						<div class="btn-group" style="margin-bottom: 20px; clear: both;">
                                <select size="3" name="trainers[]" class="form-control" style="margin-left: 10px;" multiple>
                                            <?php
												$techrs = array();
												if($training != null)
													foreach($training->trainers as $tech)
														$techrs[] = $tech->id;
												
                                                foreach(UserModel::where('user_type', '=', 1)->get() as $trainer){
                                                   if($trainer != null){
													 if(in_array( $trainer->id, $techrs)){
														echo
														 '<option value = "'.$trainer->id.'" selected>'.$trainer->first_name.' '.$trainer->last_name.'</option>';
													 }else{
														 echo '<option value = "'.$trainer->id.'">'.$trainer->first_name.' '.$trainer->last_name.'</option>';
													}
												   }
                                                }
                                            ?>

                                </select>

                            </div>
                                        <div class="row"></div>
            			<div class="btn-group" style="margin-bottom: 20px; clear: both;">
			            		
							   <?php
									//if($training->group != null){
										echo '<label >Groups:</label></br>';
										echo '<select name="group" class="form-control" style="margin-left: 10px;">';
									//}
											
								if($training != null)
								echo '<option value= ""></option>';
								foreach(GroupModel::all() as $group){
									if($group != null)
										
										if($training->group != null && $group->id == $training->group->id)
											echo '<option value= "'.$group->id.'" selected> '.$group->name.' </option>';
										else
											echo '<option value= "'.$group->id.' "> '.$group->name.' </option>';
								}
								//if($training->group != null)
									echo '</select>';
							   ?>
						</div>
                                </td>
                                <td>

                                    <select name="users[]" class="form-control" multiple="" style="margin-left: 10px;">
                                       <?php
                                       $usrs = array();
                                       if($training != null)
                                       foreach($training->users as $usr2)
                                            $usrs[] = $usr2->id;

                                       foreach(UserModel::all() as $usr){
                                            if($usr != null){
                                            if(in_array( $usr->id, $usrs)){
                                                echo'<option value = "'.$usr->id.'" selected> '.$usr->first_name.'  '.$usr->last_name.' </option>';
                                            }else{

                                                echo'<option value = "'.$usr->id.'"> '.$usr->first_name.'  '.$usr->last_name.' </option>';

                                            }
                                            }else{
                                                echo'<option value = ""></option>';
                                            }

                                       }
                                       ?>
                                    </select>

                                </td>
                                </tr>
                        </table>

                                <div style="margin-top: 10px; clear: both;">

                                    <button type="submit" class="btn btn-success btn-xs" onclick ="hidePopup('edit_practice')">Ok</button>

                                    <a href = "javascript:void(0)" onclick = "hidePopup('edit_practice')" class="btn btn-danger btn-xs">Cancel</a>
                                </div>

                                {{ Form::close() }}
                                @endif

	    </div>

    </div>


</div>

@stop