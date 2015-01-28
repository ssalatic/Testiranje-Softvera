@extends('layout')

@section('head')
    <style>
        body{
            padding-top: 70px;
        }
		
		option{
			height:40px;
		}
		
		.header{
            font-style: italic;
            font-weight: bold;
        }
		
		thead {
			background-color: rgb(200, 200, 200);
		 }
    	 
		.label{
			white-space: nowrap;
			text-overflow: ellipsis;
			display: block;
			overflow: hidden
		}
    </style>
 @stop

 @section('content')

		<div class="row">
		<div class="col-sm-3">
			<div class="header"><h4>Series</h4></div>
				<form role="search">
					<div class="form-group">
                         <input type="text" placeholder="Search" class="form-control">
                    </div>
                </form>
				<select class="form-control" multiple="" onchange="location=this.options[this.selectedIndex].value">
					<?php
						$series = CostumeTypeModel::all();
						//echo $costumeType;
						if(count($series) != 0)
						foreach($series as $cT){
							$igumani = $cT->costumes()->getResults();
							if(count($igumani) == 0){
									if($cT == $costumeType)
										echo '<option value ="'.route('emptyPage',$cT->id).'" selected>'.$cT->name.'</option>';
									else
								//echo '<option>'.$cT->name.'</option>';
										echo '<option value ="'.route('emptyPage',$cT->id).' ">'.$cT->name.'</option>';
									continue;
							}
							$i = $igumani[0];
							if($cT == $costumeType)
								echo '<option value ="'.route('costumes.show',$i->id).'" selected>'.$cT->name.'</option>';
							else
								//echo '<option>'.$cT->name.'</option>';
								echo '<option value ="'.route('costumes.show',$i->id).' ">'.$cT->name.'</option>';
						}
					?>
				</select>
				<br/>

			<form id="add_costumeType" method="POST" class="form-horizontal" action="{{ URL::route('add.costumetype') }}">
				<div class="input-group">
					<input type="text" id="costume_type" name="costume_type" class="form-control" placeholder="Costume type...">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-default" type="button">Add</button>
					</span>
				</div>
			</form>
		</div>
        <div class="col-sm-3">
			<div class="header"><h4>Red Costumes</h4></div>
				<form role="search">
					<div class="form-group">
                         <input type="text" placeholder="Search" class="form-control">
                    </div>
                </form>
				<select class="form-control" multiple="" size = "4" onchange="location=this.options[this.selectedIndex].value">
					<?php
						//echo $costumeType;
						if(count ($costumes) != 0){
						foreach($costumes as $c)
							if($c == $costume)
								echo '<option value ="'.route('costumes.show',$c->id).' " selected >'.$c->identifier.'</option>';
							else
								echo '<option value ="'.route('costumes.show',$c->id).' ">'.$c->identifier.'</option>';
						}
					
					?>
				</select>
				<br/>
			<form id="add_costume" method="POST" class="form-horizontal" action="{{ URL::route('add.costume') }}">
				<div class="input-group">
					<input type="hidden" name="id" value="<?php echo count($costumeType) == 0 ? 0 : $costumeType->id;?>" />
					<input type="text" id="costume_name" name="costume_name" class="form-control" placeholder="Costume name...">
					<span class="input-group-btn">
						<button  type="submit" class="btn btn-default" type="button">Add</button>
					</span>
				</div>
			</form>
		</div>

	{{ Form::open(['method' => 'PUT', 'class'=>"form-horizontal", 'route' => ['costumes.update', count($costume) == 0 ? 1 : $costume->id]]) }}

		<div class="col-sm-2 form-group" style="margin-top: 3%;">
			<label for="name">Name</label><br/>
			<?php 
				if( count($costume) != 0 ) 
					echo '<input type="text" id="name" name="name" value ="'.$costume->identifier.'" class="form-control input-sm />"';
				else 	
					echo '<input type="text" id="name" name="name" class="form-control input-sm />"';
			?>
			<label for="size">Size</label><br/>
			<?php 
				if( count($costume) != 0 ) 
					echo '<input type="text" id="size" name="size" value ="'.$costume->size.'" class="form-control input-sm />"';
				else 	
					echo '<input type="text" id="size" name="size" class="form-control input-sm />"';
			?>
			<label for="possesion">Possesion</label><br/>
			<?php 
			if( count($costume) != 0 ) {
				$user_in_posesion = $costume->userInPossesion()->getResults();
				echo '<input type="text" id="possesion" name="possesion" value ="'.$costume->owner.'" class="form-control input-sm />"';
			}
			else 
				echo '<input type="text" id="possesion" name="possesion" class="form-control input-sm />"';
			?>
			
			</div>

			<div class="form-group">
				<!-- Do NOT use name="submit" or id="submit" for the Submit button -->
				<button type="submit" class="btn btn-success btn-xs">Save</button>
			</div>

	{{ Form::close() }}





		</div>
        <div class="col-sm-4">
			<div class="header"><h4>Select Users</h4></div>
				<form role="search">
					<div class="form-group">
                         <input type="text" placeholder="Search" class="form-control">
                    </div>
                </form>
				<select class="form-control" multiple="">
					<option>Grand Masters</option>
					<option>Random name</option>
				</select>
		</div>

    </div>
@stop