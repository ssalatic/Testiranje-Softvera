@extends('...layout')

@section('head')

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="styles/zabuto_calendar.min.css">

    <style>
        #schedule_span {
            font-family: Monaco, Menlo, Consolas, 'Courier New', monospace;
            font-size: 13px;
            line-height: 18px;
            white-space: pre-wrap;
            background-color: rgb(255, 255, 255);
        }

        .panel-content {

        }

        #large-header, #small-header{
            font-style: italic;
        }
    </style>

    <!-- JavaScript -->
    <script src="jscript/zabuto_calendar.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#schedule").zabuto_calendar();
        });
    </script>
@stop

@section('content')
    <div class="row">
        <div class="hidden-xs col-sm-12" id="large-header" align="center">
            <h2>Welcome back Bane, bussy week ahead of you, check out what's going on</h2>
        </div>

        <div class="visible-xs col-sm-12" id="small-header" align="center">
            <h2>Here's what's up</h2>
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
                    <table>
                        <tr>
                            <td>Trening 101</td>
                            <td><img /> Bane Majstor</td>
                            <td class="hidden-xs">Introduction to Irish step dancing</td>
                            <td>15. Sep 2014<br/>15:00h</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Competitions</h3>
                </div>
                <div class="panel-body">
                    <table>
                        <tr>
                            <td>Irish top 100</td>
                            <td>Petar Petrovic</td>
                            <td class="hidden-xs">Your category is Light jig, <br/>intermediate</td>
                            <td>5. Sep 2014<br/>20:00h</td>
                        </tr>
                        <tr>
                            <td>House cup</td>
                            <td>Ivan Ivanovic</td>
                            <td class="hidden-xs">Together with M.Markovic,<br/>P.Petrovic and J.Jovanovic</td>
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
                    <table>
                        <tr>
                            <td>Happy dance</td>
                            <td>Main Dancer</td>
                            <td class="hidden-xs">You will be performing in 3 coreographies</td>
                            <td>22. Sep 2014<br/>21:00h</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="hidden-xs"><h2 align="center" style="font-weight: bold;">Calendar</h2></div>
            <div id="schedule"></div>
            <label for="groups">Show me information for these groups:</label><button id="groups" class="btn btn-default">Groups</button>
        </div>

    </div>
@stop