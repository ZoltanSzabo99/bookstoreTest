<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<p>Login page</p>
    <form action="" method="POST">
        <input type="text" name="firstNameLogin" placeholder="first name">
        <input type="text" name="lastNnameLogin" placeholder="last name">
        <input type="password" name="passwordLogin" placeholder="password">
        <input type="submit" name="sendSubmitLogin" value="Submit">
    </form>
    <a href="index.php">Back to the main page</a>
</body>
</html>

<?php
/*
3. Create 'login.php' page
	This page will display a form where a user can login using email/password.
	You have to check all mandatories input, otherwise display a message.
	When all input are fill, you have to check if the user exists in the database and check if its password/email matches.

*/

include_once('database.php');;
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
$db_found = mysqli_select_db($conn,$db_name);  


if (isset($_POST['sendSubmitLogin'])){
    
   
    $usersFirstNamePost = $_POST['firstNameLogin']; 
    $usersLastNamePost = $_POST['lastNnameLogin'];
    $usersPasswordPost = $_POST['passwordLogin'];
    //$usersPasswordPost = password_hash($_POST['passwordLogin'],PASSWORD_DEFAULT);
    
    $querySelect =
    "
    SELECT * FROM users;
    ";

    $vaidation = "";

    if($db_found){ 
    $resultSQL = mysqli_query($conn,$querySelect); 
   
        
    while($db_record = mysqli_fetch_assoc($resultSQL)){ 
       
        $usersFirstName = $db_record['first_name']; 
        $usersLastName = $db_record['last_name'];
        $usersPassword = $db_record['password'];
    
        $usersDeHashedPassword = password_verify($usersPasswordPost,$usersPassword);
        
        echo('<br>');
        echo('user post   : '.$usersPasswordPost);
        echo('<br>');
        echo('db password : '. $usersPassword);
        echo('<br>');
        var_dump( $usersDeHashedPassword);
        echo('<br>');

        // use https://www.php.net/manual/en/function.password-verify.php
        if($usersFirstName == $usersFirstNamePost && $usersLastName==$usersLastNamePost && $usersDeHashedPassword=="true") {

            $vaidation = "true";
            break;
        }else
         {
            $vaidation = "false";  
        }
        
   
    }  
}else{
    echo("$db_name NOT found");
}

if($vaidation=="true"){
    echo("Your are in");
}else{
    echo("No existing user");
   
}


}






?>