<?php

/**
	 * A method to enture that any data POST-ed does
	 * not have any spaces.
	 * 
	 * 	@return True
	 * 	will return true if there are spaces.
	 *  False will return false if there are no spaces.
	 * 	@author James Bach (i7983164)
	 * 	@version 0.9
	 * 	@var <b>$tolerance</b> 
	 *		 is an integer value that is used to determine
	 * 	the maximum amount of times the delimiter can occur
	 * 	before throwing an error. eg. if you want to allow one space before 
	 *  throwing an error, have the tolerance set to 1.
	 * 
	 * 
	 */

	function delimiterTester($value, $delimiter,$tolerance){
    	//	We could cast the type here, but then we would lose
    	//	out on additional checks.
    	//	This If checks to see whether or not the tolerance
    	//	value is something we can convert into an int.
		if(is_numeric($tolerance)){
			$tolerance = intval($tolerance);
			if(!is_int($tolerance)){
				return "enter a numerical value for the tolerance";
			}
		}
		$exploder   =   explode($delimiter,$value);
	    if(count($exploder)>$tolerance+1){
	      //  Exploder has found something, return true
	      //  to say that it has   
	        return true;
	    }
	    //else, return false.
	    return false; 
	}
	/**
	 * A method which cleans the values inputted to it, 
	 * then checks to see if the cleaned values will then 
	 * pass a series of tests on their input.
	 * 
	 * @author	James Bach	(i7983164)
	 * @version 0.9
	 * @return
	 * 	Returns <b>true</b> on anything that fails the checks.<br/>
	 * 	Returns <b>false</b> on anything that succeeds checks.<br/>
	 * @todo
	 * More malleability when it comes to user input. 
	 */
	 
	function inputCleaner($value){
	    $toBeTested		=       strip_tags($value);
	    //  Instead of using HTMLStripSpecialChars, I am using some Regex
		//  to have a greater degree of control over the input.
		//	This regex checks the entire string for anything that
		//	could ruin our consistency.
	    $regExp   = ("/[\!\"\£\$\%\^\&\*\(\)\;\'\,\"\?]/ ");
	    if(preg_match_all($regExp, $toBeTested,$matches)){
	      	return false;
		}
		else{
			return $toBeTested;
		}
	}
	
	/**
	*	What can only be described as 'reinventing the wheel', 
	*	this function checks if the value is in fact an integer 
	*	value.
	*	
	*	is_numeric does this. 
	*/
	
	function isInteger($value){
		$regExp =	"/[0-9]/";
		$toBeTested = trim($value);
		$tested= preg_match_all($regExp, $toBeTested,$matches);
		if(count($matches[0]) != strlen($toBeTested)){
			return false;
		}
		return true;
	}
?>