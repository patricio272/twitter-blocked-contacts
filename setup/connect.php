<?php
$connect = mysql_connect("localhost","root","pato272");
mysql_set_charset('utf8', $connect); // necesario para poner lo caracteres especiales (á é í... ñ) a utf8 
if (!$connect)
{
	die('Could not connect: ' . mysql_error());
}
?>