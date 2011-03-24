<?php
	//Logs in to the mysql and selects the database
	$usr = "group18";
	$pwd = "able7prime7";
	$host = "dec20";
	$db = $usr;
	$server = mysql_connect($host, $usr, $pwd) or die(mysql_error());
	mysql_select_db($db) or die(mysql_error());
	
	if(!isset($_SESSION))
{
session_start();
}

$U_ID = $_SESSION['U_ID'];
$U_EMAIL_ADDRESS = $_SESSION['U_EMAIL_ADDRESS'];
$U_FIRST_NAME = $_SESSION['U_FIRST_NAME'];
$U_SURNAME = $_SESSION['U_SURNAME'];
$U_PHONE_NUMBER = $_SESSION['U_PHONE_NUMBER'];
$U_PASSWORD = $_SESSION['U_PASSWORD'];


$q = "UPDATE USER SET U_EMAIL_ADDRESS = '$U_EMAIL_ADDRESS' , U_FIRST_NAME = '$U_FIRST_NAME', U_SURNAME = '$U_SURNAME',
U_PHONE_NO = '$U_PHONE_NUMBER', U_PASSWORD = '$U_PASSWORD'
 WHERE U_ID = '$U_ID'";
	mysql_query($q) or die(mysql_error());
echo"$U_EMAIL_ADDRESS updated.";

include('ViewUser.php');

?>