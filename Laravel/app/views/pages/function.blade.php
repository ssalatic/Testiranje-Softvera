@section('head')
@stop
<?php	
	$id = $_REQUEST["id"];
	$user = UserModel::getUserWithId($id);
	$content = '<tr>
					<td>First name:</td><td><span id="first_name">'.$user->first_name.'</span></td>
                </tr>';
	echo $content;

?>

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