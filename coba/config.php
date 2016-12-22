<?php
$host = "localhost";
$user = "root";
$pass = "";
$dtbs = "coba";
$wurl = "http://localhost/coba";
$conn = mysql_connect($host, $user, $pass);
if(!$conn)
{
	echo "Cannot connect MYSQL Database!";
}
mysql_select_db($dtbs);
?>