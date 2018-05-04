<?php
session_start();

include 'connect.php';
$connect = getDBConnection();

//Checking credentials in database
$sql = "SELECT * FROM users
        WHERE username = :username  
            AND password = :password";
            
$stmt = $connect ->prepare($sql);
$data = array(":username" => $_POST['username'], ":password" => sha1($_POST['password']));

// echo "Data: ";
// print_r($data);

$stmt->execute($data);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

echo "User: ";
print_r($user);

//redirecting user to quiz if credentials are valid
if(isset($user['username']))
{
    $_SESSION['username'] = $user['username'];
    header('Location: index.php');
} else {

    echo "The values you entered were incorrect. <a href = 'login.php'> Retry </a>";
    
}
?>