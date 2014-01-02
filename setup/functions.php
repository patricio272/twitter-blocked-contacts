<?php
// ini_set('display_errors', '1');
require_once('config.php');
require_once('connect.php');

/**
/* Saves requester screen_name, oauth_token, oauth_token_secret for later use (permanency) on DB
/* @param string $requester_screen_name : Requester Screen Name
/* @param string $oauth_token : Requester Oauth Token
/* @param string $oauth_token_secret : Requester Oauth Token Secret
*/
function save_requester_data($requester_screen_name, $oauth_token, $oauth_token_secret){
    $query = "INSERT INTO requesters (screen_name, oauth_token, oauth_token_secret) values ('" . $requester_screen_name . "', '" . $oauth_token . "', '" . $oauth_token_secret . "');";
    $result = pg_query($GLOBALS['dbconn'], $query);
    if(!$result){
        $error= pg_last_error($GLOBALS['dbconn']);
        if(strstr($error,"duplicate key value")){
            //this requester has already checked his blocked contacts
        }
    }
}
?>