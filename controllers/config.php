<?php
	
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'root';
	$dbname = 'weather';

  $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, 8889);
  return $link;
?>