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
		 .outer {
				width:100%;
				height:100%;
				display:box;
				box-orient:horizontal;
				box-pack:center;
				box-align:center;
		 }
		 
		 option{
			height:40px;
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
	
	#new_competition {
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

	.btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    </style>

    <script>

        $(document).ready(function() {
            $('select[name=type2]').change(function(event) {

                window.open($('select[name=type2] option:selected').val(),"_self")

            });
        });


    </script>
@stop

@section('content')
		<div class="row">
			<div class="col-lg-6">
				<a href = "javascript:void(0)" onclick = "document.getElementById('new_competition').style.display='block';document.getElementById('fade').style.display='block'" class="btn btn-success btn-xs">Add New</a>
				<a href = "javascript:void(0)" onclick = "document.getElementById('new_competition').style.display='block';document.getElementById('fade').style.display='block'" class="btn btn-success btn-xs">Edit</a>

				{{ Form::open(['method' => 'DELETE', 'onSubmit' => 'return confirm("You sure??");', 'route' => ['competitions.destroy', $comp->id]]) }}

                {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) }}

                {{ Form::close() }}
			</div>
		</div>
		<div class="row">
		<div class="col-sm-3">
			<div class="header"><h4>Select competition</h4></div>
				<form role="search">
				    <ul class="errors">

                        @foreach($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
					<div class="form-group">
                         <input name="search" type="text" placeholder="Search" class="form-control" onsubmit="<?php route("competitions.show", 0); ?>">
                    </div>
                </form>
				<select name="type2" class="form-control" multiple>

                <?php
                    foreach($comps as $cmps){

                        if ($cmps->id == $comp->id)
                            echo'<option selected value = "'.route('competitions.show', $cmps->id) .'">'. $cmps->name.'</option>';
                        else
                            echo'<option value = "'.route('competitions.show', $cmps->id) .'"> '.$cmps->name.' </option>';
                    }
                ?>

				</select>
		</div>
        <div class="col-sm-3">
            	<div class="header" align="center"><h4><?php echo $comp->name; ?></h4></div>
                <div align="center">
					 <table class="table table-striped table-hover ">
						<tbody>
						<?php
						    echo '
                                <tr>
                                    <td>Start date:</td>
                                    <td>' .$comp->date_start. '</td>
                                </tr>
							';
							echo '
                                <tr>
                                    <td>End date:</td>
                                    <td>' .$comp->date_end. '</td>
                                </tr>
                            ';
							echo '
                                <td>Location:</td>
                                    <td>' .$comp->location. '</td>
                                <tr>
							';
							echo '
                                <td>Judges:</td>
                                    <td>
                                        <ul>';
                                        $judges = explode( ';', $comp->judges);
                                        foreach($judges as $judge){
                                            echo '<li>'. $judge .'</li>';
                                        }
                                echo'
                                </ul>
                                    </td>
                                </tr>
							';
                        echo '
                            <td>Musicians:</td>
                                <td>
                                    <ul>';
                                    $musicians = explode( ';', $comp->musician);
                                    foreach($musicians as $musician){
                                        echo '<li>'. $musician .'</li>';
                                    }
                            echo'
                            </ul>
                                </td>
                            </tr>
                        ';
							//<td>Organizer:</td>
							//	<td>Random lik</td>
							//</tr>
							?>
						</tbody>
					</table>

                </div>
            <div class="header">
				<div class="col-sm-6"><h4>Files</h4></div>

				<div class="col-sm-2 col-sm-offset-1"><a href = "javascript:void(0)" onclick = "document.getElementById('new_file').style.display='block';document.getElementById('fade').style.display='block'" class="btn btn-info btn-xs">Add new file</a></div>
			-</div>
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

                            echo '
                                <tr>
                                    <td>1</td>
                                    <td><a href='. route('download', $file->file_name ) .'>'.$file->file_name.'</a></td>
                                    <td><span class="label label-success">'.$file->file_type.'</span></td>
                                    <td>';
                                    echo"
                                         ".Form::open(['method' => 'DELETE', 'onSubmit' => 'return confirm("You sure??");', 'route' => ['competitions.destroyFile', $file->id]])."

                                         ".Form::submit('Delete', ['class' => 'btn btn-danger btn-xs'])."

                                         ".Form::close()." ";
                                         echo'
                                    </td>

                                </tr>
                                <tr>
                                    <td></td>
                                </tr>
                            ';

                    }

                   /* <tr>
                        <td>2</td>
                        <td><a href="#">Photos</a></td>
                        <td><span class="label label-danger">Photo</span></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td><a href="#">Coreography</a></td>
                        <td><span class="label label-info">PDF</span></td>
                    </tr>*/
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-6">
            <div class="header">
				<div class="col-sm-6"><h4>Competitors</h4></div>
    			<div class="col-sm-3 col-sm-offset-3"><a href = "javascript:void(0)" onclick = "document.getElementById('new_competitor').style.display='block';document.getElementById('fade').style.display='block'" class="btn btn-info btn-xs">Add new competitor</a></div>
			</div>

            <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Level</th>
                        <th>Place</th>
                        <th>Star</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($parts as $participation)
                            foreach($participation->users as $user){
                                echo '
                                    <tr>
                                        <td><a href="'.route('users.show', $user->id).'">'. $user->first_name .' '.$user->last_name .'</a> </td>
                                        <td><span class="label label-primary"> '. $participation->competitionType['name'].' </span></td>
                                        <td>'.$participation->competitionLevel['name'].'</td>
                                        <td>'.$user->pivot->result.'</td>
                                       <td>
                                             <div class="checkbox">
                                                <label>';
                                                    if($participation->star){
                                                        echo '<input  type="checkbox" disabled="" checked><p></p>';
                                                    }
                                                    else{
                                                        echo '<input type="checkbox" disabled=""><p></p>';
                                                    }
                                echo '
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                ';
                            }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
	</div>
	<div id="new_competitor" class="white_content">
		<div class="row">
		<div class="col-sm-6">
			<div class="header"><h4>Select user you want to add</h4></div>
				<form role="search">
					<div class="form-group">
                         <input type="text" placeholder="Search" class="form-control">
                    </div>
                </form>
				<select class="form-control" multiple="">
					<option>Petar Petrovic</option>
					<option>Marko Markovic</option>
					<option>Pera Peric</option>
				</select>
			</div>
        <div class="col-sm-6">
            <div class="panel panel-success">
                <div class="panel-body" align="center">
					<div class="btn-toolbar">
						<label>
							<div class="btn-group">
								<a href="#" class="btn btn-primary btn-xs">Solo</a>
								<a href="#" class="btn btn-primary btn-xs">Team</a>
							</div>
						</label>
					</div>
					<form>
					<label for="name" class="control-label">Age Category:</label><br>
					<input type="text" id="name" class="form-control" /><br>
					<label for="music" class="control-label">Level:</label><br>
					<input type="text" id="music" class="form-control" /><br>
					<label for="rythn" class="control-label">Type:</label><br>
					<input type="text" id="rythm" class="form-control" /><br>
					<label for="tempo" class="control-label">Result:</label><br>
					<input type="text" id="tempo" class="form-control" /><br>
					<div class="checkbox">
						<label>
							<input type="checkbox"> Star
						</label>
					</div>
					</form>
                </div>
            </div>
        </div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<a href="#" class="btn btn-success btn-xs">Add Competitor</a>
				<a href = "javascript:void(0)" onclick = "document.getElementById('new_competitor').style.display='none';document.getElementById('fade').style.display='none'" class="btn btn-danger btn-xs">Cancel</a>
		</div>
		</div>

    </div>

        <!-- Add new files -->
		<div id="new_file" class="white_content">

			<table class="table table-striped table-hover" style="width:100%;">
                <tr>
                    <td>
                        {{ Form::open(['route' => ['competitions.upload', $comp->id], 'files' => true]) }}

                        {{ Form::label('file','File') }}

                        {{ Form::file('file') }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ Form::submit('Save',['class'=>'btn btn-success btn-xs']) }}

                        {{ Form::close() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href = "javascript:void(0)" onclick = "document.getElementById('new_file').style.display='none';document.getElementById('fade').style.display='none'" class="btn btn-danger btn-xs">Cancel</a>
                    </td>
                </tr>
				</table>

	    </div>


		<div id="new_competition" class="white_content">
			
                <div class="panel-body" align="center">
					<form>
					<label for="name" class="control-label">Name:</label><br>
					<input type="text" id="name" class="form-control" /><br>
					<label for="date" class="control-label">Date:</label><br>
					<input type="date" id="date"  class="form-control"/><br>
					<label for="location" class="control-label">Location:</label><br>
					<input type="text" id="location" class="form-control" /><br>
					<label for="judges" class="control-label">Judges:</label><br>
					<input type="text" id="judges" class="form-control" /><br>
					<label for="musisician" class="control-label">Musician:</label><br>
					<input type="text" id="musician" class="form-control" /><br>
					<label for="organizer" class="control-label">Organizer:</label><br>
					<input type="text" id="ogranizer" class="form-control" /><br>
                    <p>[Ages missing here. Will be added later]</p>
					</form>
                </div>
			<a href="#" class="btn btn-success btn-xs">Save Competition</a>
			<a href = "javascript:void(0)" onclick = "document.getElementById('new_competition').style.display='none';document.getElementById('fade').style.display='none' " class="btn btn-danger btn-xs">Cancel</a>
</div>
	<div id="fade" class="black_overlay"></div>
@stop