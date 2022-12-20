<?php
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}	
$emails=test_input($_GET['emails']);
require_once('connect.php');
$query = "UPDATE  `registration` SET ApprovalStatus='Approved' where Email='".$emails."'";
$results=mysqli_query($link,$query);
if ($results) {

	echo '<script type="application/javascript">';
	echo 'alert("Account Approved Successfully, you can now login");';
	echo 'window.location.href="https://panobooking.com/Login";';
	echo '</script>';


} else {
	//Account creation failed, thow the user an error message
	echo '<script type="application/javascript">';
	echo 'alert("Account Could not be Approved");';
	echo 'window.location.href="https://panobooking.com/Register";';
	echo '</script>';
}
?>