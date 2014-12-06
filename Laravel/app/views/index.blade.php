@extends('...layout')

@section('head')
    
    <!-- CSS -->
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

    <!-- JavaScript -->
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
        <div class="col-sm-7">
            <div class="hidden-xs"><h2 align="center" style="font-weight: bold;">Agenda</h2></div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Practices</h3>
                </div>
                <div class="panel-body">
                    <table class="panel-content">
                        <tr>
							<?php
							// Ovo nemamo:  '. $practice->trainer->firstName .' '.$practice->trainer->lastName .' OVO LEVO MORA SREDIMO (PROBLEMI SA ENKRIPCIJOM)
							//<td class="hidden-xs panel-content-desc">Introduction to Irish step dancing</td>
								foreach($practices as $practice){
								
									echo '
										<td>'. $practice->group->name .'</td>
										<td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>  </td>
										<td>'. $practice["date"] .'</td>
									';
								}
							?>
                            
                        </tr>
                    </table>
                </div>
            </div>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Competitions</h3>
                </div>
                <div class="panel-body">
                    <table class="panel-content">
                        <tr>
                            <td>Irish top 100</td>
                            <td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>Petar Petrovic</td>
                            <td class="hidden-xs panel-content-desc">Your category is Light jig, <br/>intermediate</td>
                            <td>5. Sep 2014<br/>20:00h</td>
                        </tr>
                        <tr>
                            <td>House cup</td>
                            <td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>Ivan Ivanovic</td>
                            <td class="hidden-xs panel-content-desc">Together with M.Markovic,<br/>P.Petrovic and J.Jovanovic</td>
                            <td>20. Sep 2014<br/>18:00h</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Concerts</h3>
                </div>
                <div class="panel-body">
                    <table class="panel-content">
                        <tr>
                            <td>Happy dance</td>
                            <td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>Main Dancer</td>
                            <td class="hidden-xs panel-content-desc">You will be performing in 3 coreographies</td>
                            <td>22. Sep 2014<br/>21:00h</td>
                        </tr>
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
                <a href="http://bootswatch.com/flatly/#" class="btn btn-primary btn-xs">Group 1</a>
                <a href="http://bootswatch.com/flatly/#" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown"><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Group 2</a></li>
                </ul>
            </div>

        </div>

    </div>
@stop	
