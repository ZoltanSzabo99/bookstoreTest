<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="signin.php">Signup</a>
    <a href="login.php">Login</a>
    <br>
</body>
</html>

<?php
/*
2. Create a page 'index.php'.
	This page will display a nice message like 'Welcome to the freakin movie website' (or whatever)
    Also display the last three movies (ordered by date of release).
    */

echo('Welcome to the freakin movie website');


include_once('database.php');
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
$db_found = mysqli_select_db($conn,$db_name);



$query =
"
SELECT title,` release_year`  
FROM movies
ORDER BY ` release_year` DESC
limit 3;
";
echo('<br>');


if($db_found){
    echo("$db_name found !");
  
    
    $result = mysqli_query($conn,$query);
    while($db_record = mysqli_fetch_assoc($result)){
        echo('<br>');
        echo('--------');
        echo('<br>');
        echo($db_record['title']);
        echo('<br>');    
        echo($db_record[' release_year']);
        echo('<br>');
        echo('--------');
        
        //echo($db_record[]);    
    }  
}else{
    echo("$db_name NOT found");}

include_once('movies.php');


mysqli_close($conn);



?>