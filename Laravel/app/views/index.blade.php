@extends('...layout')

@section('head')
	
    <style>
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
		
		.calendar{
			width: 100%;
			border-style:solid;
			border-color: #555;
			border-width:1px;
		}
		
		.calendar th{
			text-align: center;
		}
		
		.calendar-header{
			background-color: #2C3E50;
			color: white;
			width:100%;
		}
		
		.day_wrap{
			background-color:orange;
		}
		
		.days{
			background-color: #FDDC9A;
		}
		
		.is_not_event{
			width:40px;
			height:40px;
			visibility: true;
			border-radius:25px;
			visibility:hidden;
		}
		
		.is_event{
			width:40px;
			height:40px;
			border-radius:25px;
			background-color: #18BC9C;
		}
	
		.calendar td{
			border-style: solid;
			border-color: #555;
			border-width:1px;
		}
		
		td div{
			margin:auto;
		}
	
		.popbox {
			display: none;
			position: fixed;
			z-index: 99999;
			width: 400px;
			padding-left: 10px;
			padding-right:10px;
			padding-top:5px;
			padding-bottom-5px;
			background: #EEEFEB;
			color: #000000;
			border: 1px solid #4D4F53;
			margin: 0px;
			-webkit-box-shadow: 0px 0px 5px 0px rgba(164, 164, 164, 1);
			box-shadow: 0px 0px 5px 0px rgba(164, 164, 164, 1);
		}

    </style>
	
	<script>
		$(function() {
			var moveLeft = 20;
			var moveDown = 10;
			
			var id_count = 0;
			var id_num = 2;
			for(id_count = 0; id_count < id_num; id_count++)
			{
				$('#event_id-' + id_count + '-trigger').hover(function(e) {
					var target = '#' + ($(this).attr('data-popbox'));
					$(target).show();
					moveLeft = $(this).outerWidth();
					moveDown = ($(target).outerHeight() / 2);
				}, function() {
					var target = '#' + ($(this).attr('data-popbox'));
					$(target).hide();
				});
 
				$('#event_id-' + id_count + '-trigger').mousemove(function(e) {
					var target = '#' + ($(this).attr('data-popbox'));
         
					leftD = e.clientX + parseInt(moveLeft);
					maxRight = leftD + $(target).outerWidth();
					windowLeft = $(window).width() - 40;
					windowRight = 0;
					maxLeft = e.clientX - (parseInt(moveLeft) + $(target).outerWidth() + 20);
         
					if(maxRight > windowLeft && maxLeft > windowRight)
					{
						leftD = maxLeft;
					}
     
					topD = e.clientY - parseInt(moveDown);
					maxBottom = parseInt(e.clientY + parseInt(moveDown) + 20);
					windowBottom = parseInt(parseInt($(document).scrollTop()) + parseInt($(window).height()));
					maxTop = topD;
					windowTop = parseInt($(document).scrollTop());
					if(maxBottom > windowBottom)
					{
						topD = windowBottom - $(target).outerHeight() - 20;
					} else if(maxTop < windowTop){
						topD = windowTop + 20;
					}
					$(target).css('top', topD).css('left', leftD);
				});
			}
		});
	</script>
	
@stop

@section('content')
        <div class="row">
			<div class="hidden-xs col-sm-12" id="large-header" align="center">
				<h2>Welcome back <?php echo Auth::user()->first_name; ?>, bussy week ahead of you, check out what's going on</h2>
			</div>
		
			<div class="visible-xs col-sm-12" id="small-header" align="center">
				<h3>Here's what's up</h3>
			</div>
			
		</div>

		<?php
		    /*
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
		     * */
		?>
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
							foreach($practices as $practice){
                                        echo '
                                            <tr>
                                                <td>'. $practice->group->name .'</td>
                                                <td><img src="img/user.jpg" width="30" height="30" class="hidden-xs"/>  </td>
                                                <td><a href="'.route('users.show', $practice->trainer_id).'">'. UserModel::find($practice->trainer_id)->first_name .' '.UserModel::find($practice->trainer_id)->last_name .'</a></td>
                                                <td>'.  TrainingModel::find($practice->id)->date .'</td>
                                            </tr>
                                        ';
                            }
							?>
                    </table>
                    <?php
                        Paginator::setPageName('page_a');
                        echo $practices->appends('page_b', Input::get('page_b',1))->links();
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
                                        <td><a href="'.route('competitions.show', $comp->id).'">'.$comp->competition->name.'</a></td>
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
                            $concID = DB::select(DB::raw('select count(choreography_id) as broj from concert_choreography_user join concert_choreography on concert_choreography_id = concert_choreography.id where user_id = '.Auth::user()->id.' and concert_id = '. $conc->id))[0]->broj;
                            if(ConcertModel::find(ConcertChoreographyUserModel::find($conc->id)->concertChoreography->concert_id)->start_time >= date("Y-m-d H:i:s")){
                                echo '
                                    <tr>
                                        <td><a href="'.route('concerts.show', $conc->id).'">'. ConcertModel::find(ConcertChoreographyUserModel::find($conc->id)->concertChoreography->concert_id)->name .'</a></td>
                                        <td class="hidden-xs panel-content-desc">You will be performing in '. $concID .' coreographies</td>
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
            <div id="calendar_div">
				<?php
					$user = UserModel::find(Auth::user()->id);
					$practices = $user->trainings()->getResults();
	
					$current_datetime = new DateTime();
					if(isset($_GET['cdate']))
						$current_datetime = new DateTime($_GET['cdate']);
				
					$events = array();
					$current_month = $current_datetime->format("m");
					$current_year = (int)$current_datetime->format("Y");
					$num_of_days = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);
					
					echo $current_year." ".$current_month."<br/>";
					for($i=1; $i<=$num_of_days; $i++)
					{
						$datetime_at_i = new DateTime();
						$datetime_at_i->setDate($current_year, $current_month, $i);
						$events[$datetime_at_i->format("Y-m-d")] = array('<div class="is_not_event"></div>');
					}
					
					$event_count_date = 0;
					if(count($practices) != 0)
					{
						foreach($practices as $training)
						{
							$training_datetime = new DateTime($training->date);
							$date_index = $training_datetime->format("Y-m-d");
							$training_month = $training_datetime->format("m");
							$training_year = $training_datetime->format("Y");
							if($training_month == $current_month && $training_year == $current_year)
							{
								if(count($events[$date_index])==1)
								{
									$events[$date_index] = array('<div id="event_id-'.$event_count_date.'-trigger" class="is_event" data-popbox="popbox-id-'. $event_count_date.'"></div>', 
																				'<div id="popbox-id-'.$event_count_date.'" class="popbox" end></div>');
									$event_count_date++;
								}
								$trainer = UserModel::find($training->trainer_id);
								$event_data = '
								<div class="panel panel-primary">
									<div class="panel-heading">
											<h3 class="panel-title">Practice</h3>
									</div>
									<div class="panel-body" style="padding:0px;">
										<table style="width:100%;">
											<tr>
												<td>Trainer:</td><td>'.$trainer->first_name.' '.$trainer->second_name.'</td>
											</tr>
											<tr>
												<td>Starting time:</td><td>'. $training_datetime->format("H:i").'</td>
											</tr>
										</table>
									</div>
								</div>';
							
								$event_data_placeholder = $events[$date_index][1];
								$matches = array();
								preg_match('/(end)/', $event_data_placeholder, $matches, PREG_OFFSET_CAPTURE);
							
								$new_placeholder = substr_replace($event_data_placeholder, $event_data, $matches[0][1]+4, 0);
								$events[$date_index][1] = $new_placeholder;
							}
						}
					}
 				$concerts = ConcertModel::all();
				foreach($concerts as $concert)
				{
					foreach($concert->concertChoreography()->getResults() as $concert_coreography_model)
					{
						foreach($concert_coreography_model->concertChoreographyUser()->getResults() as $concert_coreography_users)
						{
							if($concert_coreography_users->user_id == $user->id)
							{
								$concert_datetime = new DateTime($concert->start_time);
								$concert_month = $concert_datetime->format("m");
								$concert_year = $concert_datetime->format("Y");
								$date_index = $concert_datetime->format("Y-m-d");
								if($concert_month == $current_month && $concert_year == $current_year)
								{
									if(count($events[$date_index])==1)
									{
										$events[$date_index] = array('<div id="event_id-'.$event_count_date.'-trigger" class="is_event" data-popbox="popbox-id-'.$event_count_date.'"></div>', 
																					'<div id="popbox-id-'.$event_count_date.'" class="popbox" end></div>');
										$event_count_date++;
									}
									$coreography = ChoreographyModel::find($concert_coreography_model->choreography_id);
									$event_data = '
									<div class="panel panel-success">
										<div class="panel-heading">
											<h3 class="panel-title">Concerts</h3>
										</div>
										<div class="panel-body" style="padding:0px;">
											<table style="width:100%;">
												<tr>
													<td>Name:</td><td>'.$concert->name.'</td>
												</tr>
												<tr>
													<td>Location:</td><td>'. $concert->location.'</td>
												</tr>
												<tr>
													<td>Start time:</td><td>'.$concert_datetime->format("H:i").'</td>
												</tr>
												<tr>
													<td>Coreography:</td><td>'.$coreography->name.'</td>
												</tr>
											</table>
										</div>
									</div>';
							
									$event_data_placeholder = $events[$date_index][1];
									$matches = array();
									preg_match('/(end)/', $event_data_placeholder, $matches, PREG_OFFSET_CAPTURE);
								
									$new_placeholder = substr_replace($event_data_placeholder, $event_data, $matches[0][1]+4, 0);
									$events[$date_index][1] = $new_placeholder;
								}
							}
						}
					}
				}
					
				$cal = Calendar::make();
				
				/**** OPTIONAL METHODS ****/
				$cal->setDate(Input::get('cdate')); //Set starting date
				$cal->setBasePath('/Testiranje-Softvera/public/'); // Base path for navigation URLs
				$cal->showNav(true); // Show or hide navigation
				
				$cal->setView(Input::get('cv')); //'day' or 'week' or null
				$cal->setStartEndHours(8,23); // Set the hour range for day and week view
				$cal->setTimeClass('ctime'); //Class Name for times column on day and week views
				
				$cal->setEventsWrap(array('<p>', '</p>')); // Set the event's content wrapper
				$cal->setDayWrap(array('<div class="day_wrap">','</div>')); //Set the day's number wrapper
				$cal->setNextIcon('<i class="fa fa-chevron-right"></i>'); //Can also be html: <i class='fa fa-chevron-right'></i>
				$cal->setPrevIcon('<i class="fa fa-chevron-left"></i>'); // Same as above
				$cal->setDayLabels(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat')); //Label names for week days
				$cal->setMonthLabels(array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December')); //Month names
				$cal->setDateWrap(array("<div>", "</div>")); //Set cell inner content wrapper
				$cal->setTableClass('calendar'); //Set the table's class name
				$cal->setLabelsClass('days');
				$cal->setHeadClass('calendar-header'); //Set top header's class name
				
				$cal->setNextClass('btn'); // Set next btn class name
				$cal->setPrevClass('btn'); // Set Prev btn class name
				
				$cal->setEvents($events); // Receives the events array
				/**** END OPTIONAL METHODS ****/

				echo $cal->generate() // Return the calendar's html;					
				?>
			</div>
        </div>

    </div>

    </div>
@stop	