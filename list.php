<?php
require_once('twitteroauth/twitteroauth.php');
require_once('setup/config.php');
require_once('setup/connect.php');
require_once('setup/functions.php');
session_start();
if(isset($_SESSION['blocked_users']) && $_SESSION['blocked_users'] != ''){
	//Getting requester user "screenname"

	$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_COOKIE['ut'], $_COOKIE['ut_s']);
	//Setting params for the request to the REST API
	$params =array();
	//Set TYPE of request to the REST API with setted "params"
	$content = $connection->get('statuses/mentions_timeline',$params);

	if($content){
		print_r($content);
		exit();
	}
	else
	{
		echo 'Cant get screen_name';
		exit(-1);
	}

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