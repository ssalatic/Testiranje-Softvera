@extends('layout')

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
		<div class="col-sm-4">
			<div class="header"><h4>Select concerts</h4></div>
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
		
			<div class="header"><h4>Random name</h4></div>
			
			
			
			<table class="user-info hidden-xs">
				<tr>
					<td>Date:</td><td><span id="first_name">15.10.2014.</span></td>
                </tr>
				<tr>
					<td>Location:</td><td><span id="last_name">Belgrade</span></td>
                </tr>
                <tr>
                    <td>Judges:</td><td><span id="birth_date">Will Smith</span></td>
                </tr>
				<tr>
					<td>Musician:</td><td><span id="social_number">Madonna</span></td>
                </tr>
            </table>
			
			
            <!--<div class="panel panel-warning">
                <div class="panel-body" align="center">
                    <table class="comp-info">
                        <tr>
                            <td>Date:</td><td><span id="comp_date">15.10.2014.</span></td>
                        </tr>
                        <tr>
                            <td>Location:</td><td><span id="comp_location">Belgrade</span></td>
                        </tr>
                        <tr>
                            <td>Judges:</td><td><span id="comp_judges">Will Smith</span></td>
                        </tr>
                        <tr>
                            <td>Musician:</td><td><span id="comp_musician">Madonna</span></td>
                        </tr>
                    </table>
                </div>
            </div>-->
            <div class="header"><h4>Files</h4></div>
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
            <div class="header"><h4>Participants</h4></div>
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Opening Act</h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover ">
					<thead>
						<tr>
							<th>Name</th><th>Costume</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>John Boo</td>
						<td>Black dress #1</td>      
					</tr>
					<tr>
						<td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>Michael Robinson</td>
						<td>Black dress #1</td>
					</tr>
					<tr>
						<td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>Alexander Robson</td>
						<td>Red dress #1</td>
					</tr>
					<tr>
						<td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>Jannifer Pinkser</td>
						<td>Red dress #2</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
            
        </div>
    </div>
</div>
@stop