<?php
	/**
	*	A function that generates a 5 star rating based on an
	*	numerical input.
	*	@author James Bach (i7983164)
	*	@version 0.8
	*	@TODO: Figure out how to generate half stars.
	*/
	function starGen($rating){
		//Array containing the star images.
		$starRating = array(
			1 => "<img src='Content/stars/starFull.png' alt='$rating'/>", 
			0.9 => "<img src='Content/stars/0.9.png' alt='$rating'/>",
			0.8 => "<img src='Content/stars/0.8.png' alt='$rating'/>",
			0.7 => "<img src='Content/stars/0.7.png' alt='$rating'/>",
			0.6 => "<img src='Content/stars/0.6.png' alt='$rating'/>", 
			0.5 => "<img src='Content/stars/0.5.png' alt='$rating'/>",
			0.4 => "<img src='Content/stars/0.4.png' alt='$rating'/>", 
			0.3 => "<img src='Content/stars/0.3.png' alt='$rating'/>",
			0.2 => "<img src='Content/stars/0.2.png' alt='$rating'/>",
			0.1 => "<img src='Content/stars/0.1.png' alt='$rating'/>",
			null => "<img src='Content/stars/starEmpty.png'/>"
		);
		//empty variables
		$score = '';
		$retainer = 1;
		//the amount of stars to generate.
		$increment = 5;
		foreach($starRating as $imgRate => $img){
			//start things
			if($retainer >0){
				//multiply by 10 so we can do things
				$retainer = $rating / $imgRate*10;
				$score .= str_repeat($img, $retainer/10);
				//=- do
				$increment = ceil($increment - $rating);
				if($rating % ($imgRate) == 0){
					if($increment >0){
						$score .= str_repeat($starRating[null],$increment);
						return $score;
					}
					else{
						return $score;
					}
				}
				else{
					$rating %= ($imgRate);
				}
			}
		}
	}
?>