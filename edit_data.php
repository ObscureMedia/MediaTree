<?
	//edit_data.php
	include ("db.inc.php");
	$id = $_POST['P_ID'];
	$P_NAME = $_POST['P_NAME'];
	$P_ARTIST = $_POST['P_ARTIST'];
	$P_DESC = $_POST['P_DESC'];
	$P_RELEASE_DATE = $_POST['P_RELEASE_DATE'];
	$P_STOCK = $_POST['P_STOCK'];
	$P_PRICE = $_POST['P_PRICE'];
	$P_IMG_REF = $_POST['P_IMG_REF'];
	$P_AGE_RATING = $_POST ['P_AGE_RATING'];
	$P_TYPE = $_POST ['P_TYPE'];
	$P_GENRE = $_POST ['P_GENRE'];	
	
	$order = "UPDATE PRODUCT SET P_NAME ='$P_NAME',
	              P_ARTIST ='$P_ARTIST',
				  P_DESC = '$P_DESC',
				  P_RELEASE_DATE = '$P_RELEASE_DATE',
				  P_STOCK = '$P_STOCK',
				  P_PRICE = '$P_PRICE',
				  P_IMG_REF = '$P_IMG_REF',
				  P_AGE_RATING = '$P_AGE_RATING',
				  P_TYPE = '$P_TYPE',
				  P_GENRE = '$P_GENRE'
				 WHERE P_ID='$id'";
	mysql_query($order) or die(mysql_error());
	mysql_close();
	header("location:get_product_hopgood.php");
?>