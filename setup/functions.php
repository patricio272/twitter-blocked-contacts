<?php
ini_set('display_errors', '1');
/**
/* Saves requester screen_name, oauth_token, oauth_token_secret for later use (permanency) on DB
/* @param string $requester_screen_name : Requester Screen Name
/* @param string $oauth_token : Requester Oauth Token
/* @param string $oauth_token_secret : Requester Oauth Token Secret
*/
function save_requester_data($requester_screen_name, $oauth_token, $oauth_token_secret){
    $query = "INSERT INTO requesters (screen_name, oauth_token, oauth_token_secret) values ('" . $screen_name . "', '" . $oauth_token . "', '" . $oauth_token_secret . "');";
    pg_query($GLOBALS['dbconn'], $query);
}
save_requester_data("patricio272", "token1", "token1_secret");
?>