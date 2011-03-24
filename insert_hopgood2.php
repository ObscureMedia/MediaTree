<?php
session_start();

	//Reporting errors back to the user
	$error_reporting = array();
	
		//Connects to the mysql server
	$conn = @mysql_connect("dec20","group18","able7prime7") or die ( "Could not connect ");
		//Connects to the database
		$rs = @mysql_select_db("group18") or die ( "Could not select database" );
		
		//If the entry has no value
	
	$nametobewritten = mysql_real_escape_string($_POST['P_NAME']);
	$artisttobewritten = mysql_real_escape_string($_POST['P_ARTIST']);
	$desctobewritten = mysql_real_escape_string($_POST['P_DESC']);
	$releasedatetobewritten = mysql_real_escape_string($_POST['P_RELEASE_DATE']);

  //if (!preg_match("([0-9]{4}[-][0-9]{2}[-][0-9]{2})", $releasedatetobewritten))
     //{
     // echo 'Date must be yyyy/mm/dd';
	//	$releasedatetobewritten == false;
      //}
	  // else
	// { $releasedatetobewritten == true;}
	$stocktobewritten = mysql_real_escape_string($_POST['P_STOCK']);
 //if (!preg_match("([0-9])", $stocktobewritten))
     //{
      //echo 'Stock must be a number';
       //$stocktobewritten == false;
      //}
	   //else
	 //{ $stocktobewritten == true;}
	$pricetobewritten = mysql_real_escape_string($_POST['P_PRICE']);
 //if (!preg_match("([0-9,.])", $pricetobewritten))
   //  {
     // echo 'Price must be a number pounds and pence seperated by a .';
	   //$pricetobewritten == false;
      //}
	  // else
	 //{ $pricetobewritten == true;}
	$imgreftobewritten = mysql_real_escape_string($_POST['P_IMG_REF']);
	$ageratingtobewritten = mysql_real_escape_string($_POST['P_AGE_RATING']);
	$typetobewritten = mysql_real_escape_string($_POST['P_TYPE']);
	$genretobewritten = mysql_real_escape_string($_POST['P_GENRE']);
	
	if(isset($_POST['P_TAGS'])){
		if(!tagToBeWritten){
			$tagToBeWritten = '';
		}
		else{
			$tagToBeWritten	= mysql_real_escape_string($_POST['P_TAGS']);
			//Insert into the product table the values inserted by the user
		}
	}
//if ($pricetobewritten == true && $stocktobewritten == true && $releasedatetobewritten == true)
	//{
	
	if(!$nametobewritten){
		$error_reporting['nameError'] = 'You must enter a value for the name';
	}
	
	if(!$artisttobewritten){
		$error_reporting['artistError'] = 'You must enter a value for the artist';
	}
	
	if(!$desctobewritten){
		$error_reporting['descError'] = 'You must enter a value for the desc';
	}
	
	if(!$releasedatetobewritten){
		$error_reporting['releasedateError'] = 'You must enter a value for the release date';
	}	
	
	if(!$stocktobewritten){
		$error_reporting['stockError'] = 'You must enter a value for the stock';
	}
	
	if(!$pricetobewritten){
		$error_reporting['priceError'] = 'You must enter a value for the price';
	}
	
	if(!$imgreftobewritten){
		$error_reporting['imgrefError'] = 'You must enter a value for the image reference';
	}
	
	if(!$ageratingtobewritten){
		$error_reporting['ageratingError'] = 'You must enter a value for the age rating';
	}
	
	if(!$typetobewritten){
		$error_reporting['typeError'] = 'You must enter a value for the type';
	}
	
	if(!$genretobewritten){
		$error_reporting['genreError'] = 'You must enter a value for the genre';
	}
		
	if(count($error_reporting)>0){
		$_SESSION['errors'] = $error_reporting;
		//header("location: form_hopgood.php");
	}
	else{
		$query = "INSERT INTO PRODUCT(P_NAME, P_ARTIST, P_DESC, P_RELEASE_DATE, P_STOCK, P_PRICE, P_IMG_REF, P_AGE_RATING, P_TYPE, P_GENRE, P_TAG) 
			VALUES ('$nametobewritten','$artisttobewritten','$desctobewritten','$releasedatetobewritten','$stocktobewritten','$pricetobewritten',
			'$imgreftobewritten','$ageratingtobewritten','$typetobewritten','$genretobewritten', '$tagToBeWritten')";
		mysql_query($query) or die ("Incorrect or Duplicate Values" . mysql_error());
		header("location: get_product_hopgood.php");
	}
	//close the mysql connection
	mysql_close();
	
?>