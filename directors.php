<?php
/*6. You have to add an attribut to the 'directors' table.
Call this attribut 'picture', it'll save the path of the picture (image) file for each director.*/
echo('<br>');
echo('Display all the directors');

require_once 'database.php';

$query =
"
SELECT * FROM directors;
";
echo('<br>');

if($db_found){ 
    $result = mysqli_query($conn,$query);
    
    while($db_record = mysqli_fetch_assoc($result)){ 
        $firstname =  $db_record['first_name']; 
        $localname = $db_record['last_name']; 
        $directorid = $db_record['director_id'];

        //echo($posters);
        echo ("<img src='$posters' >");
        echo('<br>');
        echo ($directorid);
        echo('<br>');     
        echo("<a href=movie.php?id=$directorid>$title</a>");
        //echo($title);  
        echo('<br>');
        $title = $db_record['first_name'];  
        echo($title);  
        echo('<br>');
        echo('<br>');
        $title = $db_record['last_name'];  
        echo($title);         
    }  
}else{
    echo("$db_name NOT found");}





?>