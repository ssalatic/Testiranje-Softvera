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
		 
		  .black_overlay{
		display: none;
	position: absolute;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 120%;
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
	top: 25%;
	left: 25%;
	width: 50%;
	height: 50%;
	padding: 16px;
	border: 16px solid gray;
	background-color: white;
	z-index:1002;
	overflow: auto;
}
    </style>

 @stop

 @section('content')
	
	<div class="row">

        <div class="col-sm-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Pictures</h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover ">
					<tbody>
					<tr>
						<td>Picture1</td>
					</tr>
					<tr>
						<td>Picture2</td>
					</tr>
					<tr>
						<td>Picture3</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Videos</h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover ">
					<tbody>
			    <?php
                    $alloewd_values = array("avi", "NT", "Irix", "Linux");
                    foreach($files as $file){

                        if( in_array($file[0]->file_name, $alloewd_values) ){


                            echo '
                                <tr>
                                    <td><a href="files/'.$file[0]->file_name.'">'.$file[0]->file_name.'</a></td>
                                </tr>
                            ';
                        }
                    }

                    function get_file_extension($file_name) {
                    	return substr(strrchr($file_name,'.'),1);
                    }
                ?>

					</tbody>
					</table>
				</div>
			</div>
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Files</h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover ">
					<tbody>
					<tr>
						<td>PDF1</td>     
					</tr>
					<tr>
						<td>PDF2</td>
					</tr>
					<tr>
						<td>PDF3</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
        </div>
    </div>
@stop
