<?php 
include('mysql_connect.php');
?>

<div id="CommentBox">
	<div id="CommentWrap">
		<?php 
			//Get comment data from the database. Pull 100 and paginate from there.
			$from 	=	0;
			$to 	=	100;
			$commentQry = "SELECT * FROM PRODUCT_REVIEW WHERE P_ID = P_ID AND U_ID = U_ID limit $from, $to";
			
			//$totalCommentQry:	qry the total amount of reviews for this one project. will need to join the tables to do this.
			
			$result = mysql_query($commentSQL);
			$row = mysql_fetch_array($result);
			?>
			<
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