@extends('layout')

@section('head')

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

         /* U span se nalaze konkretni podaci koji se vuku iz baze */
         .comp-info td span{
            font-weight: normal;
            font-style: italic;
            margin: 10px;
         }
    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-4">
            <div class="header"><h4>Select competition</h4></div>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="btn-group">
                        <a href="#" class="btn btn-warning btn-lg">Irish top 100</a>
                        <a href="#" class="btn btn-warning btn-lg dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Competition 2</a></li>
                        </ul>
                    </div>
                </div>
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
                        <tr>
                            <td>Organizer:</td><td><span id="comp_organizer">Neki organizator</span></td>
                        </tr>
                        <tr>
                            <td>Ages:</td>
                            <td><span id="comp_ages">
                                <ul>
                                    <li>10-15</li>
                                    <li>20-25</li>
                                    <li>23-27</li>
                                </ul>
                            </span></td>
                        </tr>
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
                    <tr>
                        <td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>John Boo</td>
                        <td><span class="label label-primary">Reel</span></td>
                        <td>Open</td>
                        <td>3</td>
                        <td>
                            <span class="button-checkbox">
                                <button type="button" class="btn" data-color="primary"><i></i></button>
                                <input type="checkbox" class="hidden" checked />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>Michael Robinson</td>
                        <td><span class="label label-primary">Reel</span></td>
                        <td>Primary</td>
                        <td>2</td>
                        <td>
                            <span class="button-checkbox">
                                <button type="button" class="btn" data-color="primary"><i></i></button>
                                <input type="checkbox" class="hidden" checked />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>Alexander Robson</td>
                        <td><span class="label label-warning">2 Hand</span></td>
                        <td>Begginers</td>
                        <td>4</td>
                        <td>
                            <span class="button-checkbox">
                                <button type="button" class="btn" data-color="primary"><i></i></button>
                                <input type="checkbox" class="hidden" checked />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>Jannifer Pinkser</td>
                        <td><span class="label label-primary">Single jig</span></td>
                        <td>Open</td>
                        <td>1</td>
                        <td>
                            <span class="button-checkbox">
                                <button type="button" class="btn" data-color="primary"><i></i></button>
                                <input type="checkbox" class="hidden" checked />
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
@stop