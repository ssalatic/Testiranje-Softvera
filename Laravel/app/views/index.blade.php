@extends('...layout')

@section('head')

    <link rel="stylesheet" type="text/css" href="styles/zabuto_calendar.min.css">
	
    <style>
		/* Stil za kalendar */
        #schedule_span {
            font-family: Monaco, Menlo, Consolas, 'Courier New', monospace;
            font-size: 13px;
            line-height: 18px;
            white-space: pre-wrap;
            background-color: rgb(255, 255, 255);




        }

        /* Sekcija za sadrzaj unutar panela, potrebno da bi se tabela razvukla preko citave sekcije */
        .panel-content{
            width: 100%;
        }

        /* Kolona sa opisom */
        .panel-content td.panel-content-desc{
            color: rgb(100, 100, 100);
            font-weight: normal;
        }

        /* Podaci unutar panela */
        .panel-content td{
            color: rgb(0, 0, 0);
            font-weight: bold;
            font-size: 10pt;
        }

        /* Zaglavlja */
        #large-header, #small-header{
            font-style: italic;
        }
    </style>
	
    <script src="jscript/zabuto_calendar.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#schedule").zabuto_calendar();  //Init kalendara
        });
    </script>

@stop

@section('content')
        <div class="row">
			<div class="hidden-xs col-sm-12" id="large-header" align="center">
				<h2>Welcome back <?php echo Auth::user()->username; ?>, bussy week ahead of you, check out what's going on</h2>
			</div>
		
			<div class="visible-xs col-sm-12" id="small-header" align="center">
				<h3>Here's what's up</h3>
			</div>
			
		</div>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4 updates">
				<p>Ovo se Ä�ita iz bekenda. Probajte da horizontalno popunjavate sa table</p>
				<div class="alert alert-dismissable alert-danger">
					<button type="button" class="close" data-dismiss="alert">Ã—</button>
					<strong>Petar Petrovic</strong>, has moved Training 101 to 15. Sep 2014.
				</div>
				<div class="alert alert-dismissable alert-warning">
					<button type="button" class="close" data-dismiss="alert">Ã—</button>
					<strong>Marko Markovic</strong>, hasn't played for 5 practices.
				</div>
			</div>
		</div>
    <div class="row">
        <div class="col-sm-7">
            <div class="hidden-xs"><h2 align="center" style="font-weight: bold;">Agenda</h2></div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Practices</h3>
                </div>
                <div class="panel-body">
                    <table class="panel-content">

                            <?php
							// Ovo nemamo:  '. $practice->trainer->firstName .' '.$practice->trainer->lastName .' OVO LEVO MORA SREDIMO (PROBLEMI SA ENKRIPCIJOM)
							//<td class="hidden-xs panel-content-desc">Introduction to Irish step dancing</td>
                            // <td>'. UserModel::find($practice->trainer_id)->first_name .'</td> PROBLEM SA ENKRIPCIJOM
                            
							foreach($practices as $practice){
                                        echo '
                                            <tr>
                                                <td>'. $practice->group->name .'</td>
                                                <td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>  </td>
                                                <td>'.  TrainingModel::find($practice->id)->date .'</td>
                                            </tr>
                                        ';

                            }
							?>

                    </table>
                    <?php
                        Paginator::setPageName('page_a');
                        echo $practices->appends('page_b', Input::get('page_b',1))->links();;
                    ?>
                </div>
            </div>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Competitions</h3>
                </div>
                <div class="panel-body">
                    <table class="panel-content">

                    <?php
                        //<td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>Petar Petrovic</td> NE TREBA
                        //<br/>20:00h</td>
                        //            <img src="img/user.jpg" width="30" height="30" class="hidden-xs"/> CIKICA

                        foreach($competitions as $comp){

                            echo '
                                    <tr>
                                        <td>'.$comp->competition->name.'</td>
                                        <td class="hidden-xs panel-content-desc">Your competitiona type is '.$comp->competitionType->name.'</td>
                                        <td class="hidden-xs panel-content-desc">Your category is '.$comp->competitionLevel->name.'</td>
                                        <td>'.$comp->competition->date_start.'</td>

                                    </tr>
                                ';

                        }

                    ?>

                    </table>
                    <?php
                        Paginator::setPageName('page_b');
                        echo $competitions->appends('page_a', Input::get('page_a',1))->links();
                    ?>
                </div>
            </div>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Concerts</h3>
                </div>
                <div class="panel-body">
                    <table class="panel-content">
                    <?php
                        //<td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>Main Dancer</td>
                        foreach($concerts as $conc){

                            if(ConcertModel::find(ConcertChoreographyUserModel::find($conc->id)->concertChoreography->concert_id)->start_time >= date("Y-m-d H:i:s")){
                                echo '
                                    <tr>
                                        <td>'. ConcertModel::find(ConcertChoreographyUserModel::find($conc->id)->concertChoreography->concert_id)->name .'</td>

                                        <td class="hidden-xs panel-content-desc">You will be performing in 3 coreographies</td>
                                        <td>'. ConcertModel::find(ConcertChoreographyUserModel::find($conc->id)->concertChoreography->concert_id)->start_time .'</td>
                                    </tr>
                                ';
                            }

                        }
                    ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="hidden-xs"><h2 align="center" style="font-weight: bold;">Calendar</h2></div>
            <div class="visible-xs"><h3 align="center" id="small-header">Or check it out on a calendar</h3></div>
            <div id="schedule"></div>
            <label for="groups">Filter groups: </label>
            <div class="btn-group">
                <?php
                    $i = 0;
                    foreach($groups as $group){
                        if($i++ == 0){
                            echo'
                                <a href="http://bootswatch.com/flatly/#" class="btn btn-primary btn-xs">'.$group->name.'</a>
                                <a href="http://bootswatch.com/flatly/#" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown"><span class="caret"></span></a>
                            ';
                        }else{
                            echo'
                                <ul class="dropdown-menu">
                                    <li><a href="#">'.$group->name.'</a></li>
                                </ul>
                            ';
                        }

                    }
                ?>
            </div>

        </div>

    </div>

    </div>
@stop	