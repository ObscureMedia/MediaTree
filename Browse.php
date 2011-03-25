<?php
include_once "ConnectAndSelect.php";
include "Includes/function_cleaner.php";
if (isset($_GET['Subcat']) && (isset($_GET['page'])) && isset($_GET['resultspage'])){
	$_GET['Subcat'] = trim($_GET['Subcat']);
	$_GET['page'] = trim($_GET['page']);
	$_GET['resultspage']= trim($_GET['resultspage']);
	if(inputcleaner($_GET['Subcat']) && inputcleaner($_GET['page']) && is_numeric($_GET['resultspage']) && inputcleaner($_GET['resultspage'])){
		$clean = true;
	}
	else{
		echo "Illegal characters have been entered. If you have reached this error through links on ObscureMedia please contact the <a href=\"mailto:admin@Obscuremedia.com\">Administrator</a> explaining how you have reached this page.";
	}
}
else {
	echo "Catagory definition is missing. If you have reached this error through links on ObscureMedia please contact the <a href=\"mailto:admin@Obscuremedia.com\">Administrator</a> explaining how you have reached this page.";
	
}
if (isset($clean) && $clean){
	$catagory = mysql_real_escape_string($_GET['Subcat'],$server);
	$page = mysql_real_escape_string($_GET['page'],$server);3;
	$resultspage = $_GET['resultspage'];
	$resultsperpage = 9;
	$from = (($resultspage*$resultsperpage)-$resultsperpage);
	if ($from > 0){
		$from =0;
		}
	if(strlen($catagory) == 1){
		$q = "SELECT P_ID, P_NAME, P_ARTIST, P_PRICE FROM PRODUCT WHERE P_TYPE ='$page' AND LEFT(P_NAME, 1)= '$catagory' LIMIT $from, $resultsperpage";
		$size = "SELECT COUNT(P_ID) FROM PRODUCT WHERE P_TYPE ='$page' AND LEFT(P_NAME, 1)= '$catagory'";
	}
	elseif (is_numeric($catagory)){
		if ($catagory <20){
			$pricelower = ($catagory-5);
			$q = "SELECT P_ID, P_NAME, P_ARTIST, P_PRICE FROM PRODUCT WHERE P_TYPE ='$page' AND (P_PRICE < $catagory AND P_PRICE > $pricelower) LIMIT $from, $resultsperpage";
			$size = "SELECT COUNT(P_ID) FROM PRODUCT WHERE P_TYPE ='$page' AND (P_PRICE < $catagory AND P_PRICE > $pricelower)";
		}
		else{
			$q = "SELECT P_ID, P_NAME, P_ARTIST, P_PRICE FROM PRODUCT WHERE P_TYPE ='$page' AND (P_PRICE > $catagory) LIMIT $from, $resultsperpage";
			$size = "SELECT COUNT(P_ID) FROM PRODUCT WHERE P_TYPE ='$page' AND (P_PRICE > $catagory)";
		}
	}
	elseif ($catagory == "ALL"){
		$q = "SELECT P_ID, P_NAME, P_ARTIST, P_PRICE FROM PRODUCT WHERE P_TYPE ='$page' LIMIT $from, 9";
		$size = "SELECT COUNT(P_ID) FROM PRODUCT WHERE P_TYPE ='$page'";
	}
	else {

		$q = "SELECT P_ID, P_NAME, P_ARTIST, P_PRICE FROM PRODUCT WHERE P_TYPE ='$page' AND (P_GENRE = '$catagory') LIMIT $from, $resultsperpage";
		$size = "SELECT COUNT(P_ID) FROM PRODUCT WHERE P_TYPE ='$page' AND (P_GENRE = '$catagory')";
	}
	$result = mysql_query($q) or die(mysql_error());
	while ($eachresult = mysql_fetch_array($result, MYSQL_ASSOC)){
		$eachpage[] = $eachresult;
	}	
	$rowcountexecute = mysql_query($size) or die(mysql_error());
	mysql_close($server);
	$numberofrows = mysql_fetch_row($rowcountexecute);	
	$numberofresults = $numberofrows[0];
	echo "<div id=\"Browse\">";
	if (isset($eachpage) && isset($_GET['resultspage'])){
		$chunkedresults = array_chunk($eachpage, 3);
		echo "<table>";
		foreach($chunkedresults as $eachresultrow){
			echo "<tr>";
			foreach ($eachresultrow as $eachresult){	
				echo "<td class=\"eachresult\">";
				foreach ($eachresult as $eachattribute){
					echo "<div class =",substr(array_search($eachattribute, $eachresult),2),">";
					if(array_search($eachattribute, $eachresult)=="P_PRICE"){					
						echo "£";	
						echo $eachattribute;	
					}
					elseif (array_search($eachattribute, $eachresult)=="P_ARTIST" ||array_search($eachattribute, $eachresult)=="P_NAME"){
						echo "<a href=\"index.php?page=Product&ID=",$eachresult['P_ID'],"\">",$eachattribute,"</a>";
					}
					elseif (array_search($eachattribute, $eachresult)=="P_ID"){
						echo "<a href=\"index.php?page=Product&ID=",$eachresult['P_ID'],"\"><img src=\"Images/",$eachresult['P_ID'],".PNG\" width=\"150px\"></a>";
					}
	
					echo "<br>";
					echo "</div>";
				}
				echo "</td>";	

			}
			echo "</tr>";
		}
		echo "</table>";
		echo "<p class = 'links'>";
		for($i=1; $i<=ceil($numberofresults/$resultsperpage); $i++){
			if ($i == $_GET['resultspage']){
				$pagetype = "pageinationcurrent";
			}
			else{
				$pagetype ="pagination";
			}
			echo "<a class=\"",$pagetype,"\" href=\"index.php?page=",$page,"&Subcat=",$catagory,"&resultspage=",$i,"\">",$i,"</a>";
		}
		echo "</p>";

	}
	else{
		echo "<p>No products were found.</p>";
		echo "<p>If you're looking for something specific, why not try the search bar at the top of the page?</p>";	
	}
	echo "</div>";	

}
?>