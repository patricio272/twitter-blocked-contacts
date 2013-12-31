<?php
session_start();
require_once('twitteroauth/twitteroauth.php');
include('config.php');


// if(isset($_SESSION['name']) && isset($_SESSION['twitter_id'])) //check whether user already logged in with twitter
// {

// 	echo "Name :".$_SESSION['name']."<br>";
// 	echo "Twitter ID :".$_SESSION['twitter_id']."<br>";
// 	echo "Image :<img src='".$_SESSION['image']."'/><br>";
// 	echo "<br/><a href='logout.php'>Logout</a>";


// }
// else // Not logged in
// {

	$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET);
	$request_token = $connection->getRequestToken($OAUTH_CALLBACK); //get Request Token

	if(	$request_token)
	{
		$token = $request_token['oauth_token'];
		// $_SESSION['request_token'] = $token ;
		// $_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];
		setcookie("ut", $request_token['oauth_token'], time() + 62208000, "/"); //cookies last 2 years
		setcookie("ut_s", $request_token['oauth_token_secret'], time() + 62208000, "/"); //cookies last 2 years
		
		switch ($connection->http_code) 
		{
			case 200:
				// $url = $connection->getAuthorizeURL($token, false);//solo autoriza, no autentiica
			$url = $connection->getAuthorizeURL($token, true);//autentifica
				//redirect to Twitter .
			header('Location: ' . $url); 
			break;
			default:
			echo "Coonection with twitter Failed";
			break;
		}

	}
	else //error receiving request token
	{
		echo "Error Receiving Request Token";
	}
	

// }



?>