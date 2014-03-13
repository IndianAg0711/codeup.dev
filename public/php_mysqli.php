<?php

$mysqli = @new mysqli('127.0.0.1', 'codeup', 'password', 'PHP_db');

if ($mysqli->connect_errno) {
	echo "failed to connect to MySQL" . PHP_EOL;
}	else {
	echo $mysqli->host_info . PHP_EOL;
}