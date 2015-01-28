@extends('...layout')

@section('head')

    <!-- Page specific CSS, JS, and other files in <head> -->
    <!-- CSS -->
    <style>
	
	/* Zaglavlja iznad panela */
        .header{
            font-style: italic;
            font-weight: bold;
        }
        /* Tabela sa podacima o takmicenjima */
        .comp-info{
            width:80%;
            font-weight: bold;
            font-size: 12pt;
        }
		
		option{
			height:40px;
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
		
        /* U span se nalaze konkretni podaci koji se vuku iz baze */
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
         /* Zaglavlja iznad panela */
         .header{
            font-style: italic;
            font-weight: bold;
         }
		 .outer {
				width:100%;
				height:100%;
				display:box;
				box-orient:horizontal;
				box-pack:center;
				box-align:center;
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
	border: 2px solid orange;
	background-color: white;
	z-index:1002;
	overflow: auto;
	}
	
	#new_choreography, #edit_choreography {
		left: 35%;
		top: 15%;
	}
	
	#new_file{
		left: 30%;
		top: 35%;
	}
	
	#new_competitor {
		left: 32%;
		top: 15%;
	}
    </style>

@stop

@section('content')
		<div class="row">
			<div class="col-lg-6">
				<a href = "javascript:void(0)" onclick = "document.getElementById('new_choreography').style.display='block';document.getElementById('fade').style.display='block'" class="btn btn-success btn-xs">Add New</a>
				<a href = "javascript:void(0)" onclick = "document.getElementById('edit_choreography').style.display='block';document.getElementById('fade').style.display='block'" class="btn btn-success btn-xs">Edit</a>
				<a href="#" class="btn btn-danger btn-xs">Delete</a>
			</div>
		</div>
		<div class="row">
		<div class="col-sm-4">
			<div class="header"><h4>Select choreography</h4></div>
				<form role="search">
					<div class="form-group">
                         <input type="text" placeholder="Search" class="form-control">
                    </div>
                </form>
				<select class="form-control" size="3" multiple="" onchange="location=this.options[this.selectedIndex].value">
					
					<?php
						//$choreographies = ChoreographyModel::getAll();
						foreach($choreographies as $chor){
							//choreographies.show
							echo '<option value = "'.route('choreographies.show', $chor->id).'"> '.$chor->name.' </option>';
					 	}
					?>
					<!--
					<option>Grand Masters</option>
					<option>Random name</option>
					-->
				</select>
		</div>
        <div class="col-sm-4">
				<div class="header"><h4><?php echo $choreography->name; ?></h4></div>
            	<table class="user-info hidden-xs">
				<tr>
					<td>Music:</td><td><span id="music"><?php echo $choreography->music; ?></span></td>
                </tr>
				<tr>
					<td>Rhytm:</td><td><span id="rhythm"><?php echo $choreography->rhythm; ?></span></td>
                </tr>
                <tr>
                    <td>Tempo:</td><td><span id="tempo"><?php echo $choreography->tempo; ?></span></td>
                </tr>
				<tr>
					<td>Duration:</td><td><span id="duration">
						<?php 
							if($choreography->duration != 0){
								$hours = (int)($choreography->duration / 60);
								$minutes = $choreography->duration - $hours*60;
								
								echo $hours.'h '.$minutes.'m';
							}
						?>
					</span></td>
                </tr>
				<tr>
					<td>Soft:</td><td><span id="soft">
						<?php 
							$output = '';
							if($choreography->soft == 1){
								$output = 'Yes';
							}else if($choreography->soft !== ''){
								$output = 'No';
							}
							echo $output; 
						?>
					</span></td>
                </tr>
				<tr>
					<td>Hard:</td><td><span id="hard">
						<?php 
							$output = '';
							if($choreography->hard == 1){
								$output = 'Yes';
							}else if($choreography->hard !== ''){
								$output = 'No';
							}
							echo $output; 
						?>
					</span></td>
                </tr>
				
            </table>
			
			<div class="header">
				<div class="col-sm-4"><h4>Files</h4></div>
				<?php
				 if($choreography->id !=0)
					echo '<div class="col-sm-2 col-sm-offset-1"><a href = "javascript:void(0)" onclick = "document.getElementById("new_file").style.display="block";document.getElementById("fade").style.display="block"" class="btn btn-info btn-xs">Add new file</a></div>';
				?>
			</div>
			<table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Type</th>
					<th>Actions</th>
				</tr>
                </thead>
                <tbody>
				
				<?php 
				 foreach($files as $file){
					echo'<tr>';
					echo'<td>'.$file->id.'</td>';
					echo '<td><a href='. route('download', $file->file_name.'.'.$file->file_type ) .'>'.$file->file_name.'</a></td>';
					echo'<td><span class="label label-success">'.$file->file_type.'</span></td>';
				?> <input type="hidden" name="id" value="<?php echo $choreography->id; ?>" />
					echo '<td>'.Form::open(['method' => 'DELETE', 'onSubmit' => 'return confirm("Are you sure??");', 'route' => ['choreographies.destroyFile', $file->id]]);
				<?php
					echo Form::submit('Delete', ['class' => 'btn btn-danger btn-xs'])."

                                         ".Form::close();
					echo '</td>';
					
					echo'</tr>';
				 }
				?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-4">
		
			<div class="header"><h4>Users</h4></div>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#know" data-toggle="tab" aria-expanded="true">Know</a></li>
				<li class=""><a href="#other" data-toggle="tab" aria-expanded="true">Other</a></li>
			</ul>
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane fade active in" id="know">
					<form role="search">
						<div class="form-group">
                            <input type="text" placeholder="Search" class="form-control">
                        </div>
                    </form>
					
					<form id="registrationForm" method="POST" class="form-horizontal" action="{{ URL::route('removeFromKnows') }}">
					
						<input type="hidden" name="id" value="<?php echo $choreography->id;?>" />
						
						<select name="know[]" class="form-control" multiple="" onChange="alertselected(this)"> 
							<?php 
								foreach($users as $user){
									echo '<option id="1" value="'.$user->id.'">'.$user->username.'</option>';
								}
							?>
							
						</select>
						
						<div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <!-- Do NOT use name="submit" or id="submit" for the Submit button -->
                            <button type="submit" class="btn btn-default">Remove</button>
                        </div>
						</div>
				</form>			
				</div>
				
				
				<div class="tab-pane fade" id="other">
					<form role="search">
						<div class="form-group">
                            <input type="text" placeholder="Search" class="form-control">
                        </div>
                    </form>
					
					 <form id="registrationForm" method="POST" class="form-horizontal" action="{{ URL::route('addToKnows') }}"> 
						
						<input type="hidden" name="id" value="<?php echo $choreography->id;?>" />
						
						<select name="other[]" class="form-control" multiple="" onChange="alertselected(this)"> 
							<?php 
								foreach($otherUsers as $user){
									echo '<option value="'.$user->id.'">'.$user->username.'</option>';
								}
							?>
						
						</select>
						
						<div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <!-- Do NOT use name="submit" or id="submit" for the Submit button -->
                            <button type="submit" class="btn btn-default">Add</button>
                        </div>
						</div>
					</form>
				</div>

		</div>	
		</div>

    </div>
	</div>
		
		
		<div id="new_file" class="white_content">
			<form action="{{ URL::route('uploadChoreographyFile') }}" method="POST" enctype="multipart/form-data">
				
				<input type="hidden" name="id" value="<?php echo $choreography->id;?>" />
				<label for="_name" class="control-label">File Name:</label><br>
				<input type="text" name="fileName" id="fileName" class="form-control" /><br>
				<input type="file" name="fileToUpload" id="fileToUpload"/><br>
				
				<button type="submit" class="btn btn-success btn-xs">Add File</button>
				<a href = "javascript:void(0)" onclick = "document.getElementById('new_file').style.display='none';document.getElementById('fade').style.display='none' " class="btn btn-danger btn-xs">Cancel</a>	
			</form>
		</div>
		<div id="new_choreography" class="white_content">
                <div class="panel-body" align="center">
					<form  id="registrationForm" method="POST" class="form-horizontal" action="{{ URL::route('choreographies.store') }}">
					<label for="_name" class="control-label">Name:</label><br>
					<input type="text" name="name" id="name" class="form-control" /><br>
					<label for="music" class="control-label">Music:</label><br>
					<input type="text" name="music" class="form-control" /><br>
					<label for="rhythm" class="control-label">Rhythm:</label><br>
					<input type="text" name="rhythm" class="form-control" /><br>
					<label for="tempo" class="control-label">Tempo:</label><br>
					<input type="text" name="tempo" class="form-control" /><br>
					<label for="duration" class="control-label">Duration</label><br>
					<label for="hours" class="control-label"> Hours:</label>
					<input type="number" name="hours" min="0" max="59"/>
					<br>
					<label for="minutes" class="control-label">Minutes:</label>
					<input type="number" name="minutes" min="0" max="59"/>
					<br>
					<div class="checkbox">
						<label>
							<input name="soft"  type="checkbox" />Soft
						</label>
					</div>
					<br>
					<div class="checkbox">
						<label>
							<input name="hard"  type="checkbox" />Hard
						</label>
					</div>
					<br>
					
					<input type="hidden" name="id" value="<?php echo $choreography->id;?>" />
					
					<button type="submit" class="btn btn-success btn-xs">Add Choreography</button>
					<a href = "javascript:void(0)" onclick = "document.getElementById('new_choreography').style.display='none';document.getElementById('fade').style.display='none' " class="btn btn-danger btn-xs">Cancel</a>
					</form>
                </div>
		</div>
		
		<div id="edit_choreography" class="white_content">
                <div class="panel-body" align="center">
					{{ Form::open(['method' => 'PUT', 'style' => "margin: 15px;", 'class'=>"form-horizontal", 'route' => ['choreographies.update', $choreography->id]]) }}
				<!--	<form  id="registrationForm" method="PUT" class="form-horizontal" action="{{ URL::route('choreographies.update', $choreography->id) }}> -->
					
					<label for="_name" class="control-label">Name:</label><br>
					<input type="text" name="name" id="name" class="form-control" value="<?php echo $choreography->name; ?>"/><br>
					<label for="music" class="control-label">Music:</label><br>
					<input type="text" name="music" class="form-control" value="<?php echo $choreography->music; ?>" /><br>
					<label for="rhythm" class="control-label">Rhythm:</label><br>
					<input type="text" name="rhythm" class="form-control" value="<?php echo $choreography->rhythm ?>"/><br>
					<label for="tempo" class="control-label">Tempo:</label><br>
					<input type="text" name="tempo" class="form-control" value="<?php echo $choreography->tempo; ?>" /><br>
					<label for="duration" class="control-label">Duration</label><br>
					<label for="hours" class="control-label"> Hours:</label>
					<input type="number" name="hours" min="0" max="59" value="<?php echo (int)($choreography->duration/60) ?>"/>
					<br>
					<label for="minutes" class="control-label">Minutes:</label>
					<input type="number" name="minutes" min="0" max="59" value="<?php echo (int)($choreography->duration%60) ?>"/>
					<br>
					
					
					<div class="checkbox">
						<label>
							<input  name="soft" type="checkbox" <?php echo ($choreography->soft == 1? 'checked' : '') ?> />Soft
						</label>
					</div>
					<br>
					<div class="checkbox">
						<label>
							<input  name="hard" type="checkbox" <?php echo ($choreography->hard == 1? 'checked' : '') ?> />Hard
						</label>
					</div>
					<br>
					<button type="submit" class="btn btn-success btn-xs">Update Choreography</button>
					<a href = "javascript:void(0)" onclick = "document.getElementById('edit_choreography').style.display='none';document.getElementById('fade').style.display='none' " class="btn btn-danger btn-xs">Cancel</a>
					<!-- </form> -->
					{{ Form::close() }}
				</div>
			
			
		</div>
	<div id="fade" class="black_overlay"></div>
@stop