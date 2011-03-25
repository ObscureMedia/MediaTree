<?php 
Session_Start();
include ('ConnectAndSelect.php');
include ("Includes/starGen.php");
?>

<div id="CommentBox">
	<div id="CommentWrap">
		<?php 
			
			if(isset($_GET['vote']) && isset($_GET['reviewID'])){
				$vote = $_GET['vote'];
				$reviewID = $_GET['reviewID'];
				if($_SESSION['voteTruth'] == false || !isset($_SESSION['voteTruth'])){
				
					if($vote == 1){
						$update = "UPDATE PRODUCT_REVIEW 
							SET U_REVIEW_RATING_POS = U_REVIEW_RATING_POS  + 1
							WHERE P_ID = $id
							AND U_ID = $reviewID
							";
							mysql_query($update) or die(mysql_error());			
							unset($_GET['vote']);				
							header("location: productpages_hopgood.php?id=$id");
						
					}
					elseif($vote == -1){
						$update= "UPDATE PRODUCT_REVIEW 
							SET U_REVIEW_RATING_NEG = U_REVIEW_RATING_NEG + 1
							WHERE P_ID = $id
							AND U_ID = $reviewID
							";
							mysql_query($update) or die(mysql_error());		
							unset($_GET['vote']);
							unset($_GET['reviewID']);						
							header("location: productpages_hopgood.php?id=$id");
					}
					else{
						//blankity blank! Nothing happens.
						header("location: productpages_hopgood.php?id=$id");
					}
				}
				$_SESSION['voteTruth'] = true;
			}
			
			//Get comment data from the database. Pull 100 and paginate from there.
			$from 	=	0;
			$to 	=	100;
			$commentQry = "SELECT USER.U_ID, USER.U_FIRST_NAME, USER.U_SURNAME, USER.U_EMAIL_ADDRESS,
						PRODUCT_REVIEW.U_P_RATING, PRODUCT_REVIEW.U_P_TITLE, PRODUCT_REVIEW.U_P_REVIEW, PRODUCT_REVIEW.P_ID, PRODUCT_REVIEW.U_ID, 
						U_REVIEW_RATING_POS,
						U_REVIEW_RATING_POS + U_REVIEW_RATING_NEG U_REVIEW_TOTAL, U_REVIEW_RATING_POS - U_REVIEW_RATING_NEG TOP_REVIEWS
						FROM PRODUCT_REVIEW, USER
						WHERE USER.U_ID = PRODUCT_REVIEW.U_ID
						AND PRODUCT_REVIEW.P_ID = '$id'
						ORDER BY U_REVIEW_RATING_POS DESC,U_REVIEW_TOTAL DESC
						";
			//get an average for the total reviews.
			$ratingQry	= "SELECT AVG(U_P_RATING)
							FROM PRODUCT_REVIEW
							WHERE P_ID = $id";
			
			
			//$totalCommentQry:	qry the total amount of reviews for this one project. will need to join the tables to do this.
			$result = mysql_query($ratingQry);
			$row = mysql_fetch_array($result,MYSQL_NUM);
			$avgReview = starGen($row[0]);
			?>
			
			<table>
				<th>Customer Reviews<th>
				<tr>
					<td>Average Customer Reviews: <span title="<?php echo $row[0] . ' out of 5 stars'?>"><?php echo $avgReview?></span>
				</tr>
			</table>
			
		<?php 				
			$result = mysql_query($commentQry);
			while($row = mysql_fetch_array($result,MYSQL_BOTH)){ 
				
				$userID 	= $row['U_ID'];
				$forename 	= $row[1];
				$surname 	= $row[2];
				$rating 	= $row[4];
				$title 		= $row[5];
				$review 	= $row[6];
				$reviewPos	= $row[9];
				$reviewTotal= $row['U_REVIEW_TOTAL'];
				$score = '';
				$average  = array();
				array_push($average,$rating);
				//Get the user rating, count it down.
				$score = starGen($rating);

			?>
			<table>
				<?php 
					if($reviewTotal >0){
						echo $reviewPos . " out of " . $reviewTotal ." people found this review helpful";
					}
				// ?>
				<tr>
					<td><span title="<?php echo $rating?> out of <?php echo $rating;?> stars" ><?php echo $score; ?></span> &nbsp;<b><?php echo $title ?>	</b> by <a href="customerReview.php?id=<?php echo $userID; ?>"> <?php echo $forename." ".$surname; ?></a></td>				
				<tr>
					<td></td>
				</tr>
				<tr>
					<td><?php echo $review; ?> </td>
				</tr>   
				<tr>
					<td>Did you find this review helpful? 
					<span><a href="productpages_hopgood.php?id=<?php echo $id ?>&vote=1&reviewID=<?php echo $userID ?>"> <input type="button" value="Yes" align="right"/></a> 
					<span><a href="productpages_hopgood.php?id=<?php echo $id ?>&vote=-1&reviewID=<?php echo $userID ?>"><input type="button" value="No" align="right"/></a></span>
					</td>
				</tr>				
			</table>
			<br/>
			<br/>
		<?php						
				}
				mysql_close();
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