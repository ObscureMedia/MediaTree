<?php
//This function is used by usort() to compare values within a multidimentional array, the value of $value2's "Count" is compared to the value of $value1's "Count" where $value is the current element in the array and $value2 is the next element in the array.
//Depending on how the values compare, 1, 0, or -1 is returned, representing larger than, equal to or less than respectively. This is then used to reorder the array. 
function deepcompare($value1, $value2)
{
    if ($value2["Count"] > $value1["Count"]){
    	return 1;
    }
    elseif ($value2["Count"] === $value1["Count"]){
    	return 0;
    }
    else {
    	return -1;
    }
}	
	// An array holding the details of how the attributes are stored in the database. Keys are how the data should be refered too in the HTML and their values are column names within the database. This reduces the code required to output this information as foreach loops can be used
	$attributes = array("Title" =>'P_NAME',"Artist" =>'P_ARTIST',"Media" =>'P_TYPE',"Genre" =>'P_GENRE',"Release Date" =>'P_RELEASE_DATE');
	//Include the code found in ConnectAndSelect.php, this will connect to the server and select the database for use.
	include_once "ConnectAndSelect.php";
	//Get the current system time to be used in determining how long a search takes.
	$timestart = microtime(true);
		//takes the value of what was submitted into the search bar on the previous page and removes all leading and following whitespace. Storing under the variable $search
		$search = trim($_POST['search']);
		//takes the value of what was selected in the search combobox and stores it in the $searchcatory variable, this will be used to limit our search to only this catagory
		$searchcatagory = $_POST['searchcatagory'];
		//Check to see if the length of what was searched is 0; if so nothing was entered and the user is alerted of this.
		if (strlen($search) === 0){
			echo "EMPTY";
			//Get the current system time to mark the end of the query. This is used along with $timestart to calculate the it took to search.
			$timeend = microtime(true);
		}
		//If what was searched is more than 0 characters
		else {
			//sanatize the search by playing escape characters around it. MySQL statements will now not be recognised as such and therefore not be a part of the query 
			$clean = mysql_real_escape_string($search,$server);
			// Create the query to be executed, find all products whose name, id, artist, type or genre contain the searched value
			$q = "SELECT * FROM PRODUCT WHERE (P_NAME LIKE '%$clean%' OR P_ID = '$clean' OR P_ARTIST LIKE '%$clean%' OR P_TYPE = '$clean' OR P_GENRE LIKE '%$clean%' OR P_TAG LIKE '%$clean%')";
			// if a search catagory that is not "All" has been selected
			if ($searchcatagory != "All"){
				// append a restriction to the sql query, limiting results to only that catagory
				$q = $q.=" AND (P_TYPE = '$searchcatagory')";
			}			
			// execute the query or return an error is something goes wrong
			$result = mysql_query($q) or die(mysql_error());
			//Using mysql_fetch_array(), the results of the query are split into rows and put into an array. This loop will continue to run as long as there is new rows.
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				//dump the new row at the end of an array named $rankedresults, which will be used to order the results by relevance.			
				$rankedresults[] = $row;
				//for each attribute in the row
				foreach ($row as $eachattribute){
					//if rankedresults already has an attribute named "Count" then make it equal to itself plus however many times the searched word is found within each attribute.
					if(isset($rankedresults[array_search(end($rankedresults),$rankedresults)]["Count"])){
						$rankedresults[array_search(end($rankedresults),$rankedresults)]["Count"] += substr_count(strtolower($eachattribute), strtolower($search));	
					}
					//if rankedresults does not have the "Count" attribute then create it, setting it too the amount of times that the search word appears within the attribute
					else {
						$rankedresults[array_search(end($rankedresults),$rankedresults)]["Count"] = substr_count($eachattribute, $search);							
					}
				}			
			}
			//close the connection to the database	
			mysql_close($server);
			//if rankedresults has been created (therefore, if there has been been results returned)
			if (isset($rankedresults)){
				//sort the results using the above deepcompare function
				usort($rankedresults, 'deepcompare');
				//for each result returned
				foreach ($rankedresults as $eachresult){
					//for each attribute that a result possesses (drawn from the attribute array declared above)
					foreach ($attributes as $eachattribute){
						//place each attribute within it's own div for the sake of CSS formatting
						echo "<div class=\"$eachattribute\">";
						//find the if the searched term occours within the attribute, if so, store the first occurrence of it in the variable $pos
						$pos = strpos(strtolower($eachresult[$eachattribute]), strtolower($search));
						//output what the current attribute is, followed by a colon. "Title:" or "Artist:" for example
						echo "<p class =\"attribute\">", array_search($eachattribute, $attributes), ":","</p>";
						//If the searched term was not found in the attribute
						if ($pos === false){
							//output from the result where the key is the current attribute.
							echo "<p class =\"value\">", $eachresult[$eachattribute],"</p>";
						}
						//if the search term is found within this attribute
						else{
							//split the attribute into "chunks" on either side of a case-insenitive occurrence of the search value. The split string is then stored in an array named $containssearch.
							$containssearch = preg_split("/$search/i", $eachresult[$eachattribute]);
							//for each chunk
							foreach($containssearch as $chunks){	
								//output the chunk
								echo $chunks;	
								//if the chunk is not the last chunk
								if ($chunks != end($containssearch)){
									//output the searched value with HTML markup to display it bold in the browser
									echo "<b>$search</b>";	
								}
							}
							//As preg_split does not store the searched value in its returned array, exact matches to the search value return an empty array, in addition, this does not meet the above if statement and therefore the searched value is not outputted
							//To combat we check to see if there is an exact match between searched and the attribute. if so, searched is outputted with bold markup 
							if(strtolower($eachresult[$eachattribute]) == strtolower($search)){
								echo "<b>$search</b>";	
							}
							//A final linebreak for reading clairty
							echo "<br>";
						}
					//close the div
					echo "</div>";
					}
				//A horrizontal line is drawn between results
				echo "<hr>";						
				}
			}
			//If ranked results is not set (and therefore no results were found) alert the user	
			else{
				echo "No results found for <b>$search</b>";
			}
	
			//Get the current system time to be used in determining how long a search takes.
			$timeend = microtime(true);	
		}
		//calculate the time it took to perform the query by subtracting the time at the begining of the query from the time at its end
		$timetaken = number_format($timeend - $timestart, 3);
		//output the time it took to perform the query	
		echo "<p id=\"timetaken,\"> Query took ", $timetaken, " seconds to return results."
?>