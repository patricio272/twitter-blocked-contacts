<?php
//This file gets the callback and works with it
session_start();
require_once('twitteroauth/twitteroauth.php');
include('./setup/config.php');

if(isset($_GET['oauth_token'])){
	$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_COOKIE['ut_tmp'], $_COOKIE['ut_s_tmp']);
	$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	if($access_token)
	{
		//Delete temporal request_tokens
		setcookie("ut_tmp", "", time()-3600,"/");
		setcookie("ut_s_tmp", "", time()-3600,"/");

		$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
		setcookie("ut", $access_token['oauth_token'], time() + 62208000, "/"); //cookies last 2 years
		setcookie("ut_s", $access_token['oauth_token_secret'], time() + 62208000, "/"); //cookies last 2 years

		//Setting params for the request to the REST API
		$params =array();
		// $params['include_entities']='false';
		// $content = $connection->get('account/verify_credentials',$params);
		$params['include_entities']='false';
		$params['cursor']=-1;
		//Set TYPE of request to the REST API with setted "params"
		$content = $connection->get('blocks/list',$params);

		if($content)
		{
			// $_SESSION['name']=$content->name;
			// $_SESSION['image']=$content->profile_image_url;
			// $_SESSION['twitter_id']=$content->screen_name;

			// 	//redirect to main page.
			// header('Location: login.php'); 
			$_SESSION['blocked_users'] = $content;
			header('Location: list.php');

		}
		else
		{
			echo "<h4> Login Error </h4>";
		}
	}

	else
	{

		echo "<h4> Login Error: No oauth_verifier set</h4>";
	}

}
else //Error. redirect to Login Page.
{
	// header('Location: index.php');
	echo "Error 'oauth_token' not set";

}

?>