<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<!--
    <form action="movie.php" method="GET">
        <input type="text" name="id" placeholder="movie" value="Movie">
        <input type="submit" name="submitButton">
    </form>
-->
</body>
</html>

<?php

/*
    4. Create a page 'movie.php'.
	This page is a descriptive page for each movie. It'll display the poster, the title, the release year but also the director's name.
	This page will have to use the GET method to get the id of the movie you want to display.
	So in your adress bar it'll look like this : 'localhost/movie.php?id=1'
*//*
$movie='';
if (isset($_GET['submitButton'])){
    $movie=$_GET['id'];
    
}*/

$movie=$_GET['id'];

echo('Welcome to the freakin movie website');

include_once('database.php');
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
$db_found = mysqli_select_db($conn,$db_name);


$query =
"
SELECT title,` release_year`,posters  
FROM movies
WHERE movie_id = $movie
";
echo('<br>');


if($db_found){ 
    $result = mysqli_query($conn,$query);
    
    while($db_record = mysqli_fetch_assoc($result)){ 
        $posters =  $db_record['posters'];   
        $width = 20;
        $newHeight = 20;
        echo "<img style=\"width: $width; height: $newHeight;\" src=\"$posters\" />";
        //echo ("<img src='$posters' >");
        echo('<br>');
        $title = $db_record['title'];  
        echo($title);  
        echo('<br>');
        $title = $db_record[' release_year'];  
        echo($title);  
        echo('<br>');         
    }  
}else{
    echo("$db_name NOT found");}
	

?>