<?php
error_reporting(0); // Just so that you script won't get thrown off
if ($_GET['user']) // ?user=channelname
{
	$user = $_GET['user'];
	$token = ''; //insert token -- can never be permanant because of DailyMotion's token expiration
	$array = file_get_contents("https://api.dailymotion.com/user/{$user}/videos?access_token=" . $token . "&limit=100"); // Defining the JSON, the limit is 100 per page.
	$newList = json_decode($array);
	foreach ( $newList->list as $list )
	{
		echo "http://www.dailymotion.com/video/{$list->id}<br />";
	}
	$page = 1;
	if ($$newList->has_more == "true")
	{
		//checks if it has more pages TODO: Actually make a loop, at the most, this will grab only 300 videos
		$page++;
		$arrayz = file_get_contents("https://api.dailymotion.com/user/{$user}/videos?access_token=" . $token . "&limit=100&page={$page}"); // Defining the JSON, the limit is 100 per page.
		$newList1 = json_decode($arrayz);
		foreach ( $newList1->list as $list )
		{
			echo "http://www.dailymotion.com/video/{$list->id}<br />";
		}
		if ($newList->has_more == "true")
		{
			$page++;
			$arrayzz = file_get_contents("https://api.dailymotion.com/user/{$user}/videos?access_token=" . $token  . "&limit=100&page={$page}"); // Defining the JSON, the limit is 100 per page.
			$newList2 = json_decode($arrayzz);
			foreach ( $newList2->list as $list )
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
