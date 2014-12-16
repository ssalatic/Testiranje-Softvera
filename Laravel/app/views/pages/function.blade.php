@section('head')
@stop

<!--
	TODO:
			1. Konverzija user_type: int u string (isto vazi i za gender  0-Male, 1-Female)
			2. Srediti prikaz reset password-a
			3. Dodati skill level
			4. Dodati kostime
			5. Dodati koreografije
-->
<?php	
	
	$id = $_REQUEST["id"];
	$user = UserModel::find($id);
	
	// dobijanje svih grupa
	$fakeUserModel = new UserModel();
	$fakeUserModel->id = $user->id;
	$groups = $fakeUserModel->groups()->getResults();
	
	
	
	// pravljenje dela za grupe
	$group_content = '<tr><td>Group(s):</td><td><span id="group">';
	$len = count($groups);
	$i = 0;
	foreach($groups as $group){
		
		$group_content = $group_content.$group->name;
		if($i < $len-1){
			$group_content = $group_content.',';
		}
		$i++; 
	}
	$group_content = $group_content.'</span></td></tr>';
	
	// content tabele za prikaz profila
	$information_content = '<tr>
					<td>First name:</td><td><span id="first_name">'.$user->first_name.'</span></td>
                </tr>
				<tr>
					<td>Last name:</td><td><span id="last_name">'.$user->last_name.'</span></td>
                </tr>
				<tr>
                    <td>Birth date:</td><td><span id="birth_date">'.$user->birth_date.'</span></td>
                </tr>
				<tr>
					<td>Social number:</td><td><span id="social_number">'.$user->social_number.'</span></td>
                </tr>
				<tr>
					<td>Phone number:</td><td><span id="phone_number">'.$user->phone_number.'</span></td>
                </tr>
				<tr>
					<td>Email:</td><td><span id="email">'.$user->adress.'</span></td>
                </tr>
				<tr>
                    <td>User type:</td><td><span id="user_type">'.$user->user_type.'</span></td>
                </tr>
				<tr>
					<td>Gender:</td><td><span id="gender">'.$user->sex.'</span></td>
                </tr>' . $group_content.
				'<tr>
					<td>Size:</td>
				</tr>
				<tr>
					<td><span>Shoe</span></td><td><span id="shoe_size">'.$user->shoe_size.'</span></td>
				</tr>
				<tr>
					<td><span>Ballet</span></td><td><span id="ballet_shoe_size">'.$user->ballet_shoe_size.'</span></td>
				</tr>
				<tr>
					<td><span> Sneakers</span><td><span id="sneakers_size">'.$user->sneakers_size.'</span></td>
				</tr>
				<tr></tr>
				<tr>
						<td>samo na svom vide<a href = "javascript:void(0)" onclick = "showPopup(\'reset_message\')" class="btn btn-danger btn-xs">Reset password</a></td>
				</tr>';
	
	// deo za koreografije
	
	$choreographies = $fakeUserModel->choreographys()->getResults();
	
	$choreographies_content = '<thead><tr><th>Choreography</th></tr></thead><tbody>';
	
	foreach($choreographies as $choreography){
		$choreographies_content = $choreographies_content.'<tr><td>'.$choreography->name.'</td></tr>';
	}
	$choreographies_content = $choreographies_content.'</tbody>';
	
	
	// deo za kostime
	$costumes = $fakeUserModel->ownsCostumes()->getResults();
	
	$costumes_content = '<thead><tr><th>Costume</th></tr></thead><tbody>';
	foreach($costumes as $costume){
		$costumes_content = $costumes_content.'<tr><td>'.$costume->identifier.'</td></tr>';
	}
	
	echo $information_content.'<mm>'.$choreographies_content.'<mm>'.$costumes_content;
?>
<!--
					<thead>
						<tr>
							<th>Choreography</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td>Chor #1</td>     
					</tr>
					<tr>
						<td>Chor #2</td>
					</tr>
					<tr>
						<td>Chor #3</td>
					</tr> 
					</tbody>
-->
<!--
					<thead>
						<tr>
							<th>Costume</th>
						</tr>
					</thead>
					<tbody>
					
					<tr>
						<td>Blue small #1</td>     
					</tr>
					<tr>
						<td>Blue small #2</td>
					</tr>
					<tr>
						<td>Blue small #3</td>
					</tr> 
					</tbody>	 -->

<!--<tr>
					<td>First name:</td><td><span id="first_name">Marko</span></td>
                </tr>
				<tr>
					<td>Last name:</td><td><span id="last_name">Markovic</span></td>
                </tr>	
                <tr>
                    <td>Birth date:</td><td><span id="birth_date">1. 1. 1990.</span></td>
                </tr>
				<tr>
					<td>Social number:</td><td><span id="social_number">12345674890</span></td>
                </tr>
				<tr>
					<td>Phone number:</td><td><span id="phone_number">12345674890</span></td>
                </tr>
				<tr>
					<td>Email:</td><td><span id="email">marko@markovic.com</span></td>
                </tr>
				<tr>
                    <td>User type:</td><td><span id="user_type">Dancer</span></td>
                </tr>
				<tr>
					<td>Gender:</td><td><span id="gener">Male</span></td>
                </tr>
				
				<tr>
					<td>Group:</td><td><span id="group">101</span></td>
                </tr>
				<tr>
					<td>Size:</td>
				</tr>
				<tr>
					<td><span>Shoe</span></td><td><span id="group">45.5</span></td>
				</tr>
				<tr>
					<td><span>Ballet</span></td><td><span id="group">45.5</span></td>
				</tr>
				<tr>
					<td><span> Sneakers</span><td><span id="group">45.5</span></td>
				</tr>
				<tr></tr>
				<tr>
						<td>samo na svom vide<a href = "javascript:void(0)" onclick = "showPopup('reset_message')" class="btn btn-danger btn-xs">Reset password</a></td>
				</tr>-->