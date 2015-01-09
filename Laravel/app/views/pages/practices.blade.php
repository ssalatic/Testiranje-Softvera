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

        @if(Auth::user()->isAdmin() || Auth::user()->isTrainer())

            <div class="col-lg-6">
                            <a href = "javascript:void(0)" onclick = "showPopup('new_practice')" class="btn btn-success btn-xs">Add New</a>
                            <a href = "javascript:void(0)" onclick ="showPopup('edit_practice')" class="btn btn-success btn-xs">Edit</a>
			{{ Form::open(['method' => 'DELETE', 'onSubmit' => 'return confirm("You sure??");', 'route' => ['trainings.destroy', $training->id]]) }}

			{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) }}

			{{ Form::close() }}

            </div>

        @endif


	</div>
    <div class="row">
		<div class="col-sm-3">
			<div class="header"><h4>Upcoming Practices</h4></div>
			<ul class="nav nav-tabs">
                <li class="active"><a href="#regular" data-toggle="tab" aria-expanded="true">Regular</a></li>
            </ul>
			<?php
			// OVDE TREBA DA SE SREDI PERSONAL (NEMA U BAZI NISTA ZA TO)
			/*<ul class="nav nav-tabs">
				<li class="active"><a href="#regular" data-toggle="tab" aria-expanded="true">Regular</a></li>
				<li class=""><a href="#personal" data-toggle="tab" aria-expanded="true">Personal</a></li>
			</ul>
			*/
			?>
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane fade active in" id="regular">

					<select name="type1" class="form-control" multiple>
						<?php
						foreach($trainings as $trn){

							if ($trn->id == $training->id)
						    	echo'<option selected value = "'.route('trainings.show', $trn->id) .'">'. $trn->date.'</option>';
							else
								echo'<option value = "'.route('trainings.show', $trn->id) .'"> '.$trn->date.' </option>';
						}
						?>
					</select>
				</div>


				<div class="tab-pane fade" id="personal">
					<form role="search">
						<div class="form-group">
                            <input type="text" placeholder="Search" class="form-control">
                        </div>
                    </form>
					<select class="form-control" multiple="">
						<?php /*
                        <option>Trainer #1</option>
						<option>Trainer #2</option>*/?>
					</select>
				</div>
			</div>
		</div>
		<div class="col-sm-5">
			<table class="user-info hidden-xs">
				<tr>
					<td>Date:</td><td><span id="p_date"><?php echo $training->date; ?></span></td>
                </tr>
				<tr>
					<td>Teacher:</td><td><a href="{{route('users.show', $training->trainer_id)}}"><span id="teacher"><?php echo UserModel::find($training->trainer_id)->first_name .' '. UserModel::find($training->trainer_id)->last_name;  ?></span></a></td>
                </tr>
                <tr>
                    <td>Group:</td><td><span id="group"><?php echo GroupModel::find($training->group_id)->name;  ?></span></td>
                </tr>
			</table>
			<div class="header"><h4>Dancers</h4></div>
			<table class="table table-striped table-hover ">
				<thead>
					<td> First Name </td><td>Last Name</td><td></td>
				</thead>
			<?php

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
            <table>


            <tr>
            <td><label for="practice_date">Date:</label><br><input type="date" name="practice_date"><br/>

            <label for="time">Time:</label><br><input type="time" name="time"><br/>
            <div class="row"></div>
			<label >Teacher:</label></br>
                    <div class="btn-group" style="margin-bottom: 20px; clear: both;">
                                <select name="teacher">
                                            <?php

                                                foreach(UserModel::where('user_type', '=', 1)->get() as $trainer){

                                                   echo '
                                                      <option value = "'.$trainer->id.'">'.$trainer->first_name.' '.$trainer->last_name.'</option>

                                                    ';
                                                }
                                            ?>

                                </select>

                            </div>
                            <div class="row"></div>
			<div class="btn-group" style="margin-bottom: 20px; clear: both;">
			            <label >Group:</label></br>
                        <select name="group">
                                    <?php

                                        foreach(GroupModel::all() as $group){

                                           echo '
                                              <option value = "'.$group->id.'">'.$group->name.'</option>

                                            ';
                                        }
                                    ?>

                        </select>

                    </div>
                    </td>
                    <td>
                        <select name="users[]" class="form-control" style="margin-left: 10px;" multiple>
                           <?php
                           foreach(UserModel::all() as $usr){

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



<div id="edit_practice" class="white_content" style="width: intrinsic; position: fixed; /* or absolute */
                                                                         top: 25%;
                                                                         left: 37.5%;" >

	<div class="row">
	    <div class="col-sm-12">

            {{ Form::open(['method' => 'PUT', 'style' => "margin: 15px;", 'class'=>"row", 'route' => ['trainings.update', $training->id]]) }}

                        <table>

                        <tr>
                        <td><label for="practice_date">Date:</label><br><input type="date" name="practice_date" value="<?php echo explode(" ", $training->date)[0];?>"><br/>

                        <label for="time">Time:</label><br><input type="time" name="time" value="<?php echo explode(" ", $training->date)[1];?>"><br/>
                        <div class="row"></div>
            			<label >Teacher:</label></br>
                                <div class="btn-group" style="margin-bottom: 20px; clear: both;">
                                            <select name="teacher" >
                                                        <?php

                                                            foreach(UserModel::where('user_type', '=', 1)->get() as $trainer){

                                                               if($training->trainer_id == $trainer->id){

                                                                    echo '
                                                                        <option value = "'.$trainer->id.'" selected>'.$trainer->first_name.' '.$trainer->last_name.'</option>
                                                                    ';

                                                               }else{
                                                                        echo '
                                                                            <option value = "'.$trainer->id.'">'.$trainer->first_name.' '.$trainer->last_name.'</option>

                                                                        ';
                                                                    }
                                                            }
                                                        ?>

                                            </select>

                                        </div>
                                        <div class="row"></div>
            			<div class="btn-group" style="margin-bottom: 20px; clear: both;">
            			            <label >Group:</label></br>
                                    <select name="group">
                                                <?php

                                                    foreach(GroupModel::all() as $group){

                                                       if($training->group_id == $group->id){

                                                            echo '
                                                                <option value = "'.$group->id.'" selected>'.$group->name.'</option>
                                                            ';
                                                       }else{
                                                            echo '
                                                                <option value = "'.$group->id.'">'.$group->name.'</option>

                                                            ';
                                                        }
                                                    }
                                                ?>

                                    </select>

                                </div>
                                </td>
                                <td>

                                    <select name="users[]" class="form-control" multiple="" style="margin-left: 10px;">
                                       <?php
                                       $usrs = array();

                                       foreach($training->users as $usr2)
                                            $usrs[] = $usr2->id;

                                       foreach(UserModel::all() as $usr){

                                            if(in_array( $usr->id, $usrs)){
                                                echo'<option value = "'.$usr->id.'" selected> '.$usr->first_name.'  '.$usr->last_name.' </option>';
                                            }else{

                                                echo'<option value = "'.$usr->id.'"> '.$usr->first_name.'  '.$usr->last_name.' </option>';

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

	    </div>

    </div>


</div>

@stop