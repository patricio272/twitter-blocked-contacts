<?php
ini_set('display_errors', '1');
//PostgreSQL
$dbconn = pg_connect("host=ec2-54-197-240-180.compute-1.amazonaws.com port=5432 dbname=d25b7ic05nqp3o user=hwqhgqplrrfdwc password=ku9g2iBEq_v4bOz5g0bdrL1YB7 sslmode=require options='--client_encoding=UTF8'") or die('Could not connect: ' . pg_last_error());
//Example Query
//$result = pg_query($dbconn, "SELECT statement goes here");
?>