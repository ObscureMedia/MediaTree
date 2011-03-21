<?php 
include('mysql_connect.php');
?>

<div id="CommentBox">
	<div id="CommentWrap">
		<?php 
			$commentSQL = "SELECT * FROM PRODUCT_REVIEW WHERE P_ID = P_ID AND U_ID = U_ID limit 100";
			
			//comment title
			//user who posted + links 
			//Date posted.
			//show a link to other reviews that were posted by same user
			//Show comment
			//permalink to the comment.

		?>
	</div>
</div>