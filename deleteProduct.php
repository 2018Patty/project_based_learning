<?php
session_start();
//1.Connect DB (MySQL)
include 'connectDB.php';

//2.Get value from Login Form
$productid = $_GET['productid'];
//echo "product_id" . $productid;


// $userid = $_POST['userid'];

$_SESSION['userid'] = '1';
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
    //echo "detail : " . $detail  . "<br>";
    // echo "password : " . $password . "<br>";

    // $sql = "select * from users where username = '". $username."' and password = '". $password ."';

    //3. Generate SQL Statement
    // $sql = "update users set fullname ='{$fullname}', detail='{$detail}' where user_id = {$userid}";

    $sql = "delete from products where productID = {$productid}";

    echo $sql;

    //4.Send SQL statement to MySQL
    if ($con->query($sql)) {
        // header("Location:profile.php?userid={$userid}");
        header("Location:showproduct.php");
    }

    //5. Get result from MySQL
    // print_r($rs);
}