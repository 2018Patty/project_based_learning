<?php
session_start();
//1.Connect DB (MySQL)
include 'connectDB.php';

//2.Get value from Login Form
$productid = $_POST['productid'];
echo "product_id" . $productid;

$productName = $_POST['productName'];
$price = $_POST['price'];
$unitinStock = $_POST['unitInstock'];
$pic = $_FILES["picfile"]["name"];
// $userid = $_POST['userid'];

$_SESSION['userid'] = '1';
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
    //echo "detail : " . $detail  . "<br>";
    // echo "password : " . $password . "<br>";

    // $sql = "select * from users where username = '". $username."' and password = '". $password ."';

    //3. Generate SQL Statement
    // $sql = "update users set fullname ='{$fullname}', detail='{$detail}' where user_id = {$userid}";

    $sql = "update products set productName='{$productName}', unitPrice={$price}, unitsInStock={$unitinStock} , productPic= '{$pic}' where productID = {$productid}";

    echo $sql;

    //4.Send SQL statement to MySQL
    if ($con->query($sql)) {
        // header("Location:profile.php?userid={$userid}");
        //upload file
        // echo $_FILES["picfile"]["name"];
        $target_dir = "images/products/";
        $target_file = $target_dir . basename($_FILES["picfile"]["name"]);
        //echo $target_file.  "<br>";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["picfile"]["tmp_name"]);

        print $check;
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }


        // Check if file already exists
        // if (file_exists($target_file)) {
        //     echo "Sorry, file already exists.";
        //     $uploadOk = 0;
        // }

        // Check file size
        if ($_FILES["picfile"]["size"] > 5000000) {
            echo "Sorry, your file is too large. (5MB)";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["picfile"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["picfile"]["name"])) . " has been uploaded.";
                header("Location:showproduct.php");
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    //5. Get result from MySQL
    // print_r($rs);
}