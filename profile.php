<?php
session_start();

//1.Connect DB (MySQL)
include 'connectDB.php';


//2. get data from url
// $userid="";

// if (isset($_GET['userid'])) {
//     $userid = $_GET['userid'];
// }

//Read from Session
$userid = "";
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];


    //3. Generate SQL Statement
    $sql = "select * from users where user_id = '{$userid}'";

    // echo $sql;

    //4.Send SQL statement to MySQL
    $rs = $con->query($sql);

    //5. Get result from MySQL
    // print_r($rs);

    //6.Check result by counting number of rows
    $count_row = mysqli_num_rows($rs);

    if ($count_row == 1) {
        // echo "Found";
        $result = $rs->fetch_assoc();

        //$result['user_id']
        //$result['username']
        //$result['password']
        //$result['fullname']
        //$result['address']
        //$result['picture']

    }

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'header.php' ?>
    <div class="container">
        <div class="profile mx-auto p-4 border rounded">
            <div class="row">
                <div class="col-md-4">
                    <img src="images/users/<?php echo $result['picture']; ?>" class="img-thumbnail" alt="...">
                </div>
                <div class="col-md-8">
                    <h1>Welcome : <?php echo $result['username']; ?></h1>
                    <p>Name: <?php echo $result['fullname']; ?></p>

                    <p><?php echo $result['address']; ?></p>

                    <!-- <a class="btn btn-primary" href="edituser.php?userid= <?php //echo $result['user_id']; 
                                                                                    ?>" role="button">Edit Profile</a> -->

                    <a class="btn btn-primary" href="edituser.php" role="button">Edit Profile</a>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>
<?php

} else {
    header('Location:login.php');
}

?>

</html>