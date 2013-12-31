<?php
session_start();
if(isset($_SESSION['blocked_users']) && $_SESSION['blocked_users'] != ''){
	$list = $_SESSION['blocked_users'];
	foreach ($list->users as $key => $value) {
		$screen_name = $value->screen_name;
		$profile_image_url = $value->profile_image_url;
		echo '<a target="_blank" href="http://www.twitter.com/' . $screen_name . '"><img src="' . $profile_image_url . '">' . $screen_name . '</a><br>';
	}
}
else{
	header("Location: index.php");
}
?>