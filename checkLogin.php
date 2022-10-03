<?php
session_start();

//1.Connect DB (MySQL)
include 'connectDB.php';


//2.Get value from Login Form
$username = $_POST['username'];
$password = $_POST['password'];


// echo "username : " . $username . "<br>";
// echo "password : " . $password . "<br>";

// $sql = "select * from users where username = '". $username."' and password = '". $password ."';

//3. Generate SQL Statement
$sql = "select * from users where username = '{$username}' and password = '{$password}'";

// echo $sql;

//4.Send SQL statement to MySQL
$rs = $con->query($sql);

//5. Get result from MySQL
// print_r($rs);

//6.Check result by counting number of rows
$count_row = mysqli_num_rows($rs);


// echo $count_row;

if ($count_row == 1) {
    // echo "Found";
    $result = $rs->fetch_assoc();
    $_SESSION['userid'] = $result['user_id'];

    //send data across pages by URL
    // header("Location:profile.php?userid={$result['user_id']}");

    header("Location:profile.php");
} else {
    // echo "Not Found";
    header('Location:login.php?error=1');
}
