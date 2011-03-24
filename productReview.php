<?php 
include('mysql_connect.php');
?>

<div id="CommentBox">
	<div id="CommentWrap">
		<?php 
			//Get comment data from the database. Pull 100 and paginate from there.
			$from 	=	0;
			$to 	=	100;
			$commentQry = "SELECT USER.U_ID, USER.U_FIRST_NAME, USER.U_SURNAME, USER.U_EMAIL_ADDRESS,
						PRODUCT_REVIEW.U_P_RATING, PRODUCT_REVIEW.U_P_TITLE, PRODUCT_REVIEW.U_P_REVIEW, PRODUCT_REVIEW.P_ID, PRODUCT_REVIEW.U_ID
						FROM PRODUCT_REVIEW, USER
						WHERE USER.U_ID = PRODUCT_REVIEW.U_ID
						AND PRODUCT_REVIEW.P_ID = '43'
						";
			
			//$totalCommentQry:	qry the total amount of reviews for this one project. will need to join the tables to do this.
			
			$result = mysql_query($commentQry);

			?>
				<?php 	
				
					while($row = mysql_fetch_array($result,MYSQL_NUM)){ 
						
						$userID 	= $row[0];
						$forename 	= $row[1];
						$surname 	= $row[2];
						$rating 	= $row[4];
						$title 		= $row[5];
						$review 	= $row[6];
						$tlt = '';
						
						//Get the user rating, count it down.
						$starRating = array(
							1 => "<img src='Content/stars/starFull.png'/>", 
							0.9 => "<img src='Content/stars/0.9.png'/>",
							0.8 => "<img src='Content/stars/0.8.png'/>",
							0.7 => "<img src='Content/stars/0.7.png'/>",
							0.6 => "<img src='Content/stars/0.6.png'/>", 
							0.5 => "<img src='Content/stars/0.5.png'/>",
							0.4 => "<img src='Content/stars/0.4.png'/>", 
							0.3 => "<img src='Content/stars/0.3.png'/>",
							0.2 => "<img src='Content/stars/0.2.png'/>",
							0.1 => "<img src='Content/stars/0.1.png'/>",
						);
					
						$retainer = 1;
						foreach($starRating as $imgRate => $img){
							//multiply the rating by 5
							//retain = dividing the rating by the amount of numbers we have 
							//if the number we have left is greater than 0
								//repeat the image ref by the retaining / 5
							//modulus divide 
							if($retainer >0){
								$retainer = $rating / $imgRate*10;
								
								$tlt .= str_repeat($img, $retainer/10);
								if($rating % ($imgRate) == 0){
									break;
								}
								else{
									$rating %= ($imgRate);
								}
							}
						}

						
					?>
					<table>
						<th><b><?php echo $title ?>
						
						
						</b> by <a href="customerReview.php?id=<?php echo $userID; ?>">
						
						<?php echo $forename." ".$surname; ?></a></th>				
						
						
						<tr>
							<td><?php echo $tlt; ?></td>
						</tr>
						<tr>
							<td><?php echo $review; ?> </td>
						</tr>   
					</table>
				<?php						
						}
					?>
					
			<?php
			//comment title
			//user who posted + links 
			//Date posted.
			//show a link to other reviews that were posted by same user
			//Show comment
			//permalink to the comment.
		?>
	</div>
</div>