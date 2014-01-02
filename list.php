<?php
ini_set('display_errors', '1');
require_once('./twitteroauth/twitteroauth.php');
require_once('./setup/functions.php');
session_start();
if(isset($_SESSION['blocked_users']) && $_SESSION['blocked_users'] != ''){
	//Getting requester user "screenname"

	$oauth_token = $_COOKIE['ut'];
	$oauth_token_secret = $_COOKIE['ut_s'];
	$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
	//Setting params for the request to the REST API
	$params =array();
	$params['include_entities']='false';
	//Set TYPE of request to the REST API with setted "params"
	$content = $connection->get('account/verify_credentials',$params);
	//Link to login.php
	echo '<a href="login.php"><img src="./img/blocked_twitter.png"/></a><hr>';

	if($content){
		$requester_screen_name = $content->screen_name;
		//Saving requester data (requester_screen_name, oauth_token, oauth_token_secret)
		save_requester_data($requester_screen_name, $oauth_token, $oauth_token_secret);
		//Displaying requester info
		echo '<h2>' . $content->name . '</h2><br>';
		echo '<a href="http://www.twitter.com/' . $requester_screen_name . '">@' . $requester_screen_name . '</a><br>';
		echo '<img src="' . $content->profile_image_url . '"><br>';
		echo '<hr>';
	}
	else
	{
		echo 'Cant get screen_name';
		exit(-1);
	}

	$list = $_SESSION['blocked_users'];
	//Check if the requester has no blocked contacts
	if(count($list->users) == 0){
		echo '<b>You have 0 blocked contacts!!! <br> Congratulations, you are a really social person!!</b>';
		exit();
	}
	else{
		echo '<b>You have ' . count($list->users) . ' blocked contacts:</b><br>';
		echo '<b>Your Twitter Blocked Contacts are:</b><br>';
	}
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