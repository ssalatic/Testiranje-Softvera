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
					<td>Duration:</td><td><span id="duration"><?php echo $choreography->duration; ?></span></td>
                </tr>
				<tr>
					<td>Soft:</td><td><span id="soft"><?php echo ($choreography->soft ? 'Yes' : 'No'); ?></span></td>
                </tr>
				<tr>
					<td>Hard:</td><td><span id="hard"><?php echo ($choreography->hard ? 'Yes' : 'No'); ?></span></td>
                </tr>
				
            </table>
			
			<div class="header">
				<div class="col-sm-4"><h4>Files</h4></div>
				<div class="col-sm-2 col-sm-offset-1"><a href = "javascript:void(0)" onclick = "document.getElementById('new_file').style.display='block';document.getElementById('fade').style.display='block'" class="btn btn-info btn-xs">Add new file</a></div>
			</div>
			<table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Type</th>
                </tr>
                </thead>
                <tbody>
				
				<?php 
					foreach($files as $file){
					 echo'<tr>';
					 echo'<td>'.$file->id.'</td>';
					 echo'<td>'.$file->file_name.'</td>';
					 echo'<td><span class="label label-success">'.$file->file_type.'</span></td>';
                    //<td><a href="#">Opening ceremony</a></td>
                    //<td><span class="label label-success">Video</span></td>
					 echo'</tr>';
					}
				?>
				<!--
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
				-->
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
			<table class="table table-striped table-hover" style="width:100%;">
				<tr>
					<td>
						<span class="label label-info">Change file</span>
					</td>
					<td>
						<p>/User/Desktop/Competition/video.mpg</p>
					</td>
					</td>
					<td><span class="label label-success">Video</span></td>
				</tr>
				<tr>
						<td>
							<span class="label label-info">Change file</span>
						</td>
						<td>
							<p>/User/Desktop/Competition/coreographies.mpg</p>
						</td>
						</td>
						<td><span class="label label-info">PDF</span></td>
					</tr>
					<tr>
						<td><a href="#" class="btn btn-info btn-xs">Select file</a></td>
						<td></td>
						<td></td>
					</tr>
				</table>
				<a href="#" class="btn btn-success btn-xs">Add File</a>
				<a href = "javascript:void(0)" onclick = "document.getElementById('new_file').style.display='none';document.getElementById('fade').style.display='none'" class="btn btn-danger btn-xs">Cancel</a>
		</div>
		<div id="new_choreography" class="white_content">
                <div class="panel-body" align="center">
					<form  id="registrationForm" method="POST" class="form-horizontal" action="{{ URL::route('choreographies.store') }}>
					<label for="_name" class="control-label">Name:</label><br>
					<input type="text" name="name" id="name" class="form-control" /><br>
					<label for="music" class="control-label">Music:</label><br>
					<input type="text" id="judges" class="form-control" /><br>
					<label for="tempo" class="control-label">Tempo:</label><br>
					<input type="text" id="musician" class="form-control" /><br>
					<label for="duration" class="control-label">Duration:</label><br>
					<input type="text" id="ogranizer" class="form-control" /><br>
					<div class="checkbox">
						<label>
							<input  type="checkbox" />Hard
						</label>
					</div>
					<br>
					<div class="checkbox">
						<label>
							<input  type="checkbox" />Soft
						</label>
					</div>
					<br>
					<button type="submit" class="btn btn-success btn-xs">Save Competition</button>
					<a href = "javascript:void(0)" onclick = "document.getElementById('new_choreography').style.display='none';document.getElementById('fade').style.display='none' " class="btn btn-danger btn-xs">Cancel</a>
					</form>
                </div>
			
			
		</div>
		
		<div id="edit_choreography" class="white_content">
                <div class="panel-body" align="center">
					<form  id="registrationForm" method="POST" class="form-horizontal" action="{{ URL::route('choreographies.store') }}>
					<label for="_name" class="control-label">Name:</label><br>
					<input type="text" name="name" id="name" class="form-control" /><br>
					<label for="music" class="control-label">Music:</label><br>
					<input type="text" id="judges" class="form-control" /><br>
					<label for="tempo" class="control-label">Tempo:</label><br>
					<input type="text" id="musician" class="form-control" /><br>
					<label for="duration" class="control-label">Duration:</label><br>
					<input type="text" id="ogranizer" class="form-control" /><br>
					<div class="checkbox">
						<label>
							<input  type="checkbox" />Hard
						</label>
					</div>
					<br>
					<div class="checkbox">
						<label>
							<input  type="checkbox" />Soft
						</label>
					</div>
					<br>
					<button type="submit" class="btn btn-success btn-xs">Update Competition</button>
					<a href = "javascript:void(0)" onclick = "document.getElementById('edit_choreography').style.display='none';document.getElementById('fade').style.display='none' " class="btn btn-danger btn-xs">Cancel</a>
					</form>
                </div>
			
			
		</div>
	<div id="fade" class="black_overlay"></div>
@stop