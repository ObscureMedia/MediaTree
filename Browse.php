<?php
include_once "ConnectAndSelect.php";
include "Includes/function_cleaner.php";
if (isset($_GET['Subcat']) && (isset($_GET['page']))){
	$_GET['Subcat'] = trim($_GET['Subcat']);
	$_GET['page'] = trim($_GET['page']);
	if(inputcleaner($_GET['Subcat']) && inputcleaner($_GET['page'])){
		$clean = true;
	}
	else{
		echo "Illegal characters have been entered in \"", $_GET['Subcat'],"\"";
	}
}
if (isset($clean) && $clean){
	$catagory = mysql_real_escape_string($_GET['Subcat'],$server);
	$page = mysql_real_escape_string($_GET['page'],$server);
	if(strlen($catagory) == 1){
		$q = "SELECT P_ID, P_NAME, P_PRICE FROM PRODUCT WHERE P_TYPE ='$page' AND LEFT(P_NAME, 1)= '$catagory'";
	}
	elseif (is_numeric($catagory)){
		if ($catagory <20){
			$pricelower = ($catagory-5);
			$q = "SELECT P_ID, P_NAME, P_PRICE FROM PRODUCT WHERE P_TYPE ='$page' AND (P_PRICE < $catagory AND P_PRICE > $pricelower)";
		}
		else{
			$q = "SELECT P_ID, P_NAME, P_PRICE FROM PRODUCT WHERE P_TYPE ='$page' AND (P_PRICE > $catagory)";
		}
	}
	else {
		$q = "SELECT P_ID, P_NAME, P_PRICE FROM PRODUCT WHERE P_TYPE ='$page' AND (P_GENRE = '$catagory')";
	}
	$result = mysql_query($q) or die(mysql_error());
	while ($eachresult = mysql_fetch_array($result, MYSQL_ASSOC)){
		$allresults[] = $eachresult;
	}		
	mysql_close($server);
	echo "<div id=\"Browse\">";
	if (isset($allresults)){
		$chunkedresults = array_chunk($allresults, 3);
		echo "<table>";
		foreach($chunkedresults as $eachresultrow){
			echo "<tr>";
			foreach ($eachresultrow as $eachresult){	
				echo "<td class=\"eachresult\">";
				foreach ($eachresult as $eachattribute){
					echo "<div class =",substr(array_search($eachattribute, $eachresult),2),">";
					if(strpos($eachattribute,".") !== false && is_numeric($eachattribute)){					
						echo "£";	
						echo $eachattribute;	
					}
					elseif (!is_numeric($eachattribute)){
						echo $eachattribute;
					}
					else{
						echo "<img src=\"Images/",$eachresult['P_ID'],".PNG\" width=\"150px\">";
					}
	
					echo "<br>";
					echo "</div>";
				}
				echo "</td>";	

			}
			echo "</tr>";
		}
		echo "</table>";
	}
	else{
		echo "<p>No products were found for $catagory</p>";
	}
	echo "</div>";	

}
?>