<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';	
$emails='sales@panobooking.email';
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}	
$to = test_input(trim($_GET['hotelemail']));
$booknotes =test_input($_GET['bookingnotes']);
$messsage = "Dear Service Provider,Your Car has been ordered for renting. Please check your Panobooking Dashboard to confirm this order. or Reach out to 0741822377 for further details";

require_once('connect.php');
$sales6 ="SELECT TelephoneNumber FROM `carrentals` where EmailAddress='".$to."'";
$result5=mysqli_query($link,$sales6);
$counter=1; $numbers='';
while ($row5 = mysqli_fetch_assoc($result5)) {
	$number = trim($row5['TelephoneNumber']);
	if ($counter == 1) {
		$numbers = $number;
	} else {
		$numbers .= ',' . $number;
	}
	$counter++;
}
$headers = get_headers("http://geniussmsgroup.com/api/http/messagesService/get?username=&password=&senderid=Geniussms&message=".urlencode($messsage)."&numbers=".$numbers."");
error_log($to);
$subject = "Panobooking Sales";
$headers  = "From: " . $emails . "\r\n";
$headers .= "Reply-To: " . $emails . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n"; 

$message ='<html><body>';
$message .='<div style=" box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);transition: 0.3s;width: 80%;background-color: #F0F0F0;margin: 0 auto;float: none;margin-bottom: 10px;border-radius: 30px 30px 30px 30px;">';
$message .='<div style="text-align:center;background-color:#3383ff;width:100%;padding-top:10px;padding-bottom:10px;border-radius: 30px 30px 0px 0px;"><h1 style="text-align: center;padding:0px;font-size:20px;font-weight:500;color:white;">Booking From Panobooking</h1></div>';
$message .='<p style="font-size:15px;padding:10px; margin:10px;text-align:justify">'.$booknotes.'</p>';
$message .='<div style="padding:10px;text-align:center"><a href="https://carrental.panobooking.com/"><button style="padding:10px;text-align:center;height:50px;border-radius: 10px;background-color:#3383ff; color:white;font-size:20px;">Confirm Order</button></a></div></div>';
$message .= '</body></html>';
mail($to, $subject, $message, $headers);
?>