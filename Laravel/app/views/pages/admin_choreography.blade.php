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
    </style>

@stop

@section('content')
		<div class="row">
			<div class="col-lg-6">
				<a href = "javascript:void(0)" onclick = "document.getElementById('new_competition').style.display='block';document.getElementById('fade').style.display='block'" class="btn btn-success btn-xs">Add New</a>
				<a href = "javascript:void(0)" onclick = "document.getElementById('new_competition').style.display='block';document.getElementById('fade').style.display='block'" class="btn btn-success btn-xs">Edit</a>
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
				<select class="form-control" multiple="">
					<option>Grand Masters</option>
					<option>Random name</option>
				</select>
		</div>
        <div class="col-sm-4">
				<div class="header"><h4>English</h4></div>
            	<table class="user-info hidden-xs">
				<tr>
					<td>Music:</td><td><span id="first_name">Dzenan</span></td>
                </tr>
				<tr>
					<td>Rhytm:</td><td><span id="last_name">sta ja znam</span></td>
                </tr>
                <tr>
                    <td>Tempo:</td><td><span id="birth_date">1. 1. 1990.</span></td>
                </tr>
				<tr>
					<td>Duraction:</td><td><span id="social_number">12345674890</span></td>
                </tr>
				<tr>
					<td>Soft or Hard:</td><td><span id="email">Hard</span></td>
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
                </tbody>
            </table>
        </div>
        <div class="col-sm-4">
			<div class="header"><h4>Users who know</h4></div>
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
		<div id="new_competition" class="white_content">
                <div class="panel-body" align="center">
					<form>
					<label for="location" class="control-label">Name:</label><br>
					<input type="text" id="location" class="form-control" /><br>
					<label for="judges" class="control-label">Music:</label><br>
					<input type="text" id="judges" class="form-control" /><br>
					<label for="musisician" class="control-label">Tempo:</label><br>
					<input type="text" id="musician" class="form-control" /><br>
					<label for="organizer" class="control-label">Duraction:</label><br>
					<input type="text" id="ogranizer" class="form-control" /><br>
					<label for="organizer" class="control-label">Soft or Hard:</label><br>
					<input type="text" id="ogranizer" class="form-control" /><br>
					</form>
                </div>
			<a href="#" class="btn btn-success btn-xs">Save Competition</a>
			<a href = "javascript:void(0)" onclick = "document.getElementById('new_competition').style.display='none';document.getElementById('fade').style.display='none' " class="btn btn-danger btn-xs">Cancel</a>
</div>
	<div id="fade" class="black_overlay"></div>
@stop