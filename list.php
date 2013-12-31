<?php
if(isset($_GET['content']) && $_GET['content'] != ''){
	$list = $_GET['content'];
	//TODO : Save oauth_token and oauth_token_secret on DB, to use it later and stuff (permanency)
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