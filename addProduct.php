<?php
session_start();
//1.Connect DB (MySQL)
include 'connectDB.php';

//2.Get value from Login Form


$productName = $_POST['productName'];
$price = $_POST['unitPrice'];
$unitinStock = $_POST['unitInStock'];
$catid = $_POST['categoryID'];
$pic = $_FILES["picfile"]["name"];

echo "filename: " . $pic;
// $userid = $_POST['userid'];

$_SESSION['userid'] = '1';
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];


    $sql = "insert into products(productName,unitPrice,unitsInStock,categoryID,productPic) values ('{$productName}',{$price},{$unitinStock},{$catid},'{$pic}')";

    echo $sql;

    //4.Send SQL statement to MySQL
    if ($con->query($sql)) {
        // header("Location:profile.php?userid={$userid}");
        //header("Location:showproduct.php");


        //5. Get result from MySQL
        // print_r($rs);

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
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        header('Location:showproduct.php');
    }
}