<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<p>Signup page</p>
    <form action="" method="POST">
        <input type="text" name="firstname" placeholder="firstname">
        <input type="text" name="lastname" placeholder="lastname">
        <input type="password" name="password" placeholder="password">
        <input type="email" name="email" placeholder="email">
        <input type="submit" name="sendSubmit" value="Submit">
    </form>
    <a href="index.php">Back to the main page</a>
</body>
</html>

<?php
/*
	A User is represented by a first_name, last_name, email and password (and other stuff if you want).

	1. Create the table 'users' in your database

	2. Create 'signin.php' page
	This page will display a form where a user can enter its data to create an account
	You have to check all mandatories input, otherwise display a message.
	When all input are fill, you have to insert the user in the database and display a nice message.

	3. Create 'login.php' page
	This page will display a form where a user can login using email/password.
	You have to check all mandatories input, otherwise display a message.
	When all input are fill, you have to check if the user exists in the database and check if its password/email matches.

	4. Avoid injections, special chars.... Put in place a basic security measure.

*/

/*
Create salted password ;
$salt = 'mys4altedp4aasword';
$hash = md5($password . $salt);
or
$hash = sha($password . $salt);
use password_hash() function


*/

include_once('database.php');;
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
$db_found = mysqli_select_db($conn,$db_name);


  


if (isset($_POST['sendSubmit'])){
    //$hashedPass = password_hash($_POST['password'],PASSWORD_DEFAULT);

    $usersFirstNamePost = $_POST['firstname']; 
    $usersLastNamePost = $_POST['lastname'];
    $userEmailPost = $_POST['email'];
    //$usersPasswordPost = $_POST['password'];
    $usersPasswordPost = password_hash($_POST['password'],PASSWORD_DEFAULT);
    //echo($usersPasswordPost);
    
    $queryInsert = "
    INSERT INTO users(email,first_name,last_name,password) VALUES('$userEmailPost','$usersFirstNamePost','$usersLastNamePost','$usersPasswordPost');";

    $querySelect =
    "
    SELECT * FROM users;
    ";
    
    $vaidation = "";


    if($db_found){ 
    $resultSQL = mysqli_query($conn,$querySelect); 
   
        
    while($db_record = mysqli_fetch_assoc($resultSQL)){   
        $usersEmail = $db_record['email'];
        $usersFirstName = $db_record['first_name']; 
        $usersLastName = $db_record['last_name'];
        $usersPassword = $db_record['password'];
       // $lengthOfusersFirstName = strlen($usersFirstName);
      
   
        if($usersEmail == $userEmailPost ){
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
    echo("Email already exist");
    }else{
    echo("Registration is done");
    echo('<br>');
    var_dump(mysqli_query($conn,$queryInsert));
}


}
?>