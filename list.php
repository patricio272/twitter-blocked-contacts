<?php
require_once('./setup/config.php');
require_once('./setup/connect.php');
require_once('./setup/functions.php');
session_start();
if(isset($_SESSION['blocked_users']) && $_SESSION['blocked_users'] != ''){
	//TODO: Get requester user "screenname"
	
	//TODO: Save user oauth_token, oauth_token_secret on Heroku DB

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