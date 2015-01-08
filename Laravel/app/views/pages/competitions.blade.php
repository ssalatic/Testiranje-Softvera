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
		 
		 .label{
			white-space: nowrap;
			text-overflow: ellipsis;
			display: block;
			overflow: hidden
		}

         /* U span se nalaze konkretni podaci koji se vuku iz baze */
         .comp-info td span{
            font-weight: normal;
            font-style: italic;
            margin: 10px;
         }
		 
		 thead {
			background-color: rgb(200, 200, 200);
		 }
		 
		 .btn-group-wrap {
			text-align: center;
		}
		
		div.btn-group {
    margin: 0 auto; 
    text-align: center;
    width: inherit;
    display: inline-block;
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
        <div class="col-sm-4">
            <div class="header"><h4>Select competition</h4></div>
            <div class="panel panel-success">
                <div class="panel-heading btn-group-wrap">
                    <div class="btn-group">
                    <select name="type2" class="btn btn-success btn-lg" style="width:80%">
                        <?php
                            foreach($comps as $cmps){

                                if ($cmps->id == $comp->id)
                                    echo'<option class="btn btn-success btn-lg" style="width:80%" selected value = "'.route('competitions.show', $cmps->id) .'">'. $cmps->name.'</option>';
                                else
                                    echo'<option class="btn btn-success btn-lg" style="width:80%" value = "'.route('competitions.show', $cmps->id) .'"> '.$cmps->name.' </option>';
                            }
                        ?>
                     </select>
                    </div>
                </div>
                <div class="panel-body" align="center">
                    <table class="comp-info">
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
                    </table>
                </div>
            </div>
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
                    <?php
                        foreach($files as $file){

                                echo '
                                    <tr>
                                        <td>1</td>
                                        <td><a href='. route('download', $file->file_name ) .'>'.$file->file_name.'</a></td>
                                        <td><span class="label label-success">'.$file->file_type.'</span></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                ';

                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-8">
            <div class="header"><h4>Results</h4></div>
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
@stop