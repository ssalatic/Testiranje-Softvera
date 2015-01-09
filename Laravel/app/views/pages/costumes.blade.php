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
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Costume type...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">Add</button>
					</span>
				</div>
		</div>
        <div class="col-sm-3">
			<div class="header"><h4>Red Costumes</h4></div>
				<form role="search">
					<div class="form-group">
                         <input type="text" placeholder="Search" class="form-control">
                    </div>
                </form>
				<select class="form-control" multiple="" size = "4">
					<?php
						//echo $costumeType;
						if(count ($costumes) != 0){
						foreach($costumes as $c)
							if($c == $costume)
								echo '<option selected>'.$c->identifier.'</option>';
							else
								echo '<option>'.$c->identifier.'</option>';
						}
					
					?>
				</select>
				<br/>
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Costume name...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">Add</button>
					</span>
				</div>
		</div>
		<div class="col-sm-2 form-group" style="margin-top: 3%;">
			<label for="name">Name</label><br/>
			<?php 
				if( count($costume) != 0 ) 
					echo '<input type="text" id="name" value ="'.$costume->identifier.'" class="form-control input-sm />"';  
				else 	
					echo '<input type="text" id="name" class="form-control input-sm />"'; 
			?>
			<label for="size">Size</label><br/>
			<?php 
				if( count($costume) != 0 ) 
					echo '<input type="text" id="size" value ="'.$costume->size.'" class="form-control input-sm />"';  
				else 	
					echo '<input type="text" id="size" class="form-control input-sm />"'; 
			?>
			<label for="possesion">Possesion</label><br/>
			<?php 
			if( count($costume) != 0 ) {
				$user_in_posesion = $costume->userInPossesion()->getResults();
				echo '<input type="text" id="possesion" value ="'.$costume->identifier.'" class="form-control input-sm />"';  
			}
			else 
				echo '<input type="text" id="possesion" class="form-control input-sm />"';
			?>
			
			</div>
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