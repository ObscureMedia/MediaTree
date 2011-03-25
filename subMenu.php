<?php
$page =$_GET['page'];
foreach(range('A', 'Z') as $letter) {
    $atoz[] =$letter;
}
$headings = array("Music Genre" => array("Rock", "Pop", "Dance", "Trance", "Rap", "Live"), "DVD Genre" => array("Horror", "Comedy", "Action", "Live", "TV"), "AZ" => $atoz, "Price" => array("Under £5" => 5, "£5-10" => 10, "£10-£15" => 15, "£15+" => 20));
echo "<div id=\"subMenu\">
	<ul class = \"submenubar\">
		<li class=\"header\">",$page,"</li>";
		echo   "<li class=\"submenu\">";
		echo "<a href=",$_SERVER['PHP_SELF'],"?page=",$page,"&Subcat=ALL","&resultspage=1",">All</a>";
		echo "<br>";
		echo "</li>";		
		foreach($headings as $eachheading){
			if ($eachheading == $headings["Music Genre"]){	
				if($page == "DVD"){
					echo   "<li class=\"submenu\">";
					echo "DVD Genre";
					echo "<ul class= \"submenuholder\">";
					foreach($headings['DVD Genre'] as $DvdGenre){
						echo   "<li class=\"submenuitem\">";			
						echo "<a href=",$_SERVER['PHP_SELF'],"?page=",$page,"&Subcat=",$DvdGenre,"&resultspage=1",">",$DvdGenre,"</a>";
						echo "<br>";	
						echo    "</li>";
					}
					echo "</ul>";
				echo "</li>";	
				}
				if ($page =="CD" || $page =="Vinyl"){
					echo   "<li class=\"submenu\">";	
					echo "Music Genre";
					echo "<ul class= \"submenuholder\">";
					foreach ($headings['Music Genre'] as $MusicGenre){
						echo   "<li class=\"submenuitem\">";
						echo "<a href=",$_SERVER['PHP_SELF'],"?page=",$page,"&Subcat=",$MusicGenre,"&resultspage=1",">",$MusicGenre, "</a>";
						echo "<br>";
						echo    "</li>";
					}
					echo    "</ul>";
				echo "</li>";	
				}		
			}
			if ($eachheading != $headings["Music Genre"] && $eachheading != $headings["DVD Genre"]){
				echo   "<li class=\"submenu\">";	
				echo array_search($eachheading, $headings);
				echo "<ul class= \"submenuholder\">";
				foreach ($eachheading as $eachsubheading){
					echo   "<li class=\"submenuitem\">";
					if ($eachheading == $headings['Price']){
						echo "<a href=",$_SERVER['PHP_SELF'],"?page=",$page,"&Subcat=",$eachsubheading,"&resultspage=1",">",array_search($eachsubheading,$eachheading), "</a>";					
					}			
					else {
					echo "<a href=",$_SERVER['PHP_SELF'],"?page=",$page,"&Subcat=",$eachsubheading,"&resultspage=1",">",$eachsubheading, "</a>";
					}
					echo "<br>";
					echo    "</li>";	
				}	
				echo    "</ul>";					
			echo "</li>";
			}
		}

echo "</ul>
</div>";
?>