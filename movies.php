<?php

/*
3. Create a page 'movies.php'.
This page will display all the movies (poster first, then above title and release year).
*/

/*5. Edit the page 'movies.php'
	Make the title of each movie clickable. It'll redirect to the related descriptive movie page.*/



echo('<br>');
echo('Display all the movie');
//require_once 'database.php';
include_once('database.php');;
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
$db_found = mysqli_select_db($conn,$db_name);



$query =
"
SELECT * FROM movies;
";
echo('<br>');

if($db_found){ 
    $result = mysqli_query($conn,$query);
    
    while($db_record = mysqli_fetch_assoc($result)){ 
        $posters =  $db_record['posters']; 
        $title = $db_record['title']; 
        $movieid = $db_record['movie_id'];
        $directorid = $db_record['directorID'];

        //echo($posters);
        echo ("<img src='$posters' >");
        echo('<br>');
        echo ($movieid);
        echo('<br>');     
        echo("<a href=movie.php?id=$movieid>$title</a>");
        //echo($title);  
        echo('<br>');
        $title = $db_record[' release_year'];  
        echo($title);  
        echo('<br>');
        echo($directorid);  
        echo('<br>');
           
    }  
}else{
    echo("$db_name NOT found");}



?>