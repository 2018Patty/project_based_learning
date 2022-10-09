<?php
session_start();
//1.Connect DB (MySQL)
include 'connectDB.php';

function getuserid($username, $con)
{
    $sql = "select * from users where username = '{$username}'";

    echo $sql;

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
    }
}



//2.Get value from Register Form
$username = $_POST['username'];
$password = $_POST['password'];
$fullname = $_POST['fullname'];
$address = $_POST['address'];
$pic = $_FILES["picfile"]["name"];


//Rename filename
$filename   = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241
$extension  = pathinfo($_FILES["picfile"]["name"], PATHINFO_EXTENSION); // jpg
$newfilename   = $filename . "." . $extension;



// echo "username : " . $username  . "<br>";
// echo "password : " . $password . "<br>";
// echo "fullname : " . $fullname  . "<br>";
// echo "address : " . $address  . "<br>";
// echo "newfilename : " . $newfilename . "<br>";

// 3.Check existing username
$sqlusername = "select * from users where username = '{$username}' and password = '{$password}'";


// echo $sqlusername . "<br>";

$rs = $con->query($sqlusername);
$count_row = mysqli_num_rows($rs);


if ($count_row == 0) {

    //4.if not exist then insert into DB


    $sql = "insert into users (fullname,username,password,address,picture) values ('{$fullname}','{$username}','{$password}', '{$address}', '{$newfilename}')";

    // echo $sql;

    //5.Send SQL statement to MySQL, if insert sucessfully, then upload profile picture
    if ($con->query($sql)) {

        //upload file
        // echo $_FILES["picfile"]["name"];
        $target_dir = "images/users/";
        //$target_file = $target_dir . basename($_FILES["picfile"]["name"]);

        $target_file = $target_dir . $newfilename;

        //echo $target_file .  "<br>";
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

                getuserid($username, $con);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        header("Location:profile.php");
    }

    //5. Get rsesult from MySQL
    // print_r($rs);
}