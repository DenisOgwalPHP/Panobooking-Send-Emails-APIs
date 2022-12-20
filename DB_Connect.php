<?php
 $host = 'localhost'; $user = 'panobooking'; $pass =''; $door = 'u42893_panobooking'; 
	$link=mysqli_connect($host,$user,$pass,$door);
if ($link == false) {
	die("Error:can't connect" . mysqli_connect_error());
}

?>