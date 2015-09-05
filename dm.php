<?php
error_reporting(0); // Just so that you script won't get thrown off
if ($_GET['user']) // ?user=channelname
{
	$user = $_GET['user'];
	$token = ''; //insert token -- can never be permenant because of DailyMotion's token expiration
	$array = file_get_contents("https://api.dailymotion.com/user/{$user}/videos?access_token=" . $token . "&limit=100"); // Defining the JSON, the limit is 100 per page.
	$rawr = json_decode($array);
	foreach ( $rawr->list as $list )
	{
		echo "http://www.dailymotion.com/video/{$list->id}<br />";
	}
	$page = 1;
	if ($rawr->has_more == "true")
	{
		//checks if it has more pages TODO: Actually make a loop, at the most, this will grab only 300 videos
		$page++;
		$arrayz = file_get_contents("https://api.dailymotion.com/user/{$user}/videos?access_token=" . $token . "&limit=100&page={$page}"); // Defining the JSON, the limit is 100 per page.
		$rawrz = json_decode($arrayz);
		foreach ( $rawrz->list as $list )
		{
			echo "http://www.dailymotion.com/video/{$list->id}<br />";
		}
		if ($rawrz->has_more == "true")
		{
			$page++;
			$arrayzz = file_get_contents("https://api.dailymotion.com/user/{$user}/videos?access_token=" . $token  . "&limit=100&page={$page}"); // Defining the JSON, the limit is 100 per page.
			$rawrzz = json_decode($arrayzz);
			foreach ( $rawrzz->list as $list )
			{
				echo "http://www.dailymotion.com/video/{$list->id}<br />";
			}
		}
	}
} else {
	echo 'USAGE: ?user=';
}
?>


















?> 