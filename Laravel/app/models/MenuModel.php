<?php



class MenuModel extends \Eloquent{
	
	public static function updateMenu($route, $user){
		$menu_items = array("Home", "Practices", "Concerts", "Users", "Competitions", "Costumes", "Choreographies", "Files" );
		$menu_routes = array(route('index'), route('trainings.index'), route('concerts.index'), route('users.index'), route('competitions.index'), route('costumes.index'), route('choreographies.index'), route('gallery') );
	
		for($i = 0; $i < count($menu_items); ++$i) {
		if($i === 5 && (!$user->isAdmin() && !$user->isDesigner())) continue;
		if($i === 6 && (!$user->isAdmin() && !$user->isTrainer())) continue;
			if( URL::route($route) === $menu_routes[$i])
				echo '<li class="active" ><a href="'.$menu_routes[$i].'">'.$menu_items[$i].'</a></li>';
			else
				echo '<li><a href="'.$menu_routes[$i].'">'.$menu_items[$i].'</a></li>';
		}
	}
}

?>