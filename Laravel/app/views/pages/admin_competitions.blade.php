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
		<div class="col-sm-3">
			<div class="header"><h4>Select competition</h4></div>
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
        <div class="col-sm-3">
            	<div class="header" align="center"><h4>[Competition name goes here]</h4></div>
                <div align="center">
					 <table class="table table-striped table-hover ">
						<tbody>
							<tr>
								<td>Date:</td>
								<td>25.06.1993</td>
							</tr>
								<td>Location:</td>
								<td>Beograd</td>
							<tr>
								<td>Judges:</td>
								<td>
									<ul>
										<li>Sudac 1</li>
										<li>Sudac 2</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>Musicians:</td>
								<td>
									<ul>
										<li>Muzicar 1</li>
										<li>Muzicar 2</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>Organizer:</td>
								<td>Random lik</td>
							</tr>
						</tbody>
					</table>
                    <p>Ovdje idu godine(starosne dobi) </p>
                </div>
            <div class="header">
				<div class="col-sm-6"><h4>Files</h4></div>
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
                    <tr>
                        <td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>John Boo</td>
                        <td><span class="label label-primary">Reel</span></td>
                        <td>Open</td>
                        <td>3</td>
                       <td>
							 <div class="checkbox">
								<label>
									<input type="checkbox" disabled=""><p></p>
								</label>
							</div>
						</td>
                    </tr>
                    <tr>
                        <td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>Michael Robinson</td>
                        <td><span class="label label-primary">Reel</span></td>
                        <td>Primary</td>
                        <td>2</td>
                        <td>
							 <div class="checkbox">
								<label>
									<input type="checkbox" disabled="" checked="true"><p></p>
								</label>
							</div>
						</td>
                    </tr>
                    <tr>
                        <td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>Alexander Robson</td>
                        <td><span class="label label-warning">2 Hand</span></td>
                        <td>Begginers</td>
                        <td>4</td>
                        <td>
							 <div class="checkbox">
								<label>
									<input type="checkbox" disabled=""><p></p>
								</label>
							</div>
						</td>
                    </tr>
                    <tr>
                        <td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>Jannifer Pinkser</td>
                        <td><span class="label label-primary">Single jig</span></td>
                        <td>Open</td>
                        <td>1</td>
                        <td>
							 <div class="checkbox">
								<label>
									<input type="checkbox" disabled="" checked="true"><p></p>
								</label>
							</div>
						</td>
                    </tr>
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