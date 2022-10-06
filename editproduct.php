<?php
session_start();
//1.Connect DB (MySQL)
include 'connectDB.php';

$userid = "";
$_SESSION['userid'] = '1';
// if (isset($_GET['userid'])) {
//     $userid = $_GET['userid'];

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];

    //Get data from URL
    $productid = $_GET['productid'];

    //3. Generate SQL Statement
    $sql = "select * from products where productID = {$productid}";

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
        //$result['detail']
        //$result['picture']
        //print($result['detail']);
    }
}


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'header.php' ?>
    <div class="container">
        <div class="login mx-auto p-4 border rounded">
            <h1 class="mb-3">Edit profile : <?php echo $result['username']; ?></h1>
            <form method="post" action="updateProduct.php">

                <div class="mb-3">
                    <label for="fullname" class="form-label">Product ID</label>
                    <input type="text" class="form-control" id="productid" name="productid"
                        value="<?php echo $result['ProductID']; ?>" readonly>

                </div>
                <div class="mb-3">
                    <label for="fullname" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="productName"
                        value="<?php echo $result['ProductName']; ?>">

                </div>
                <div class="mb-3">
                    <label for="fullname" class="form-label">Price</label>
                    <input type="text" class="form-control" id="price" name="price"
                        value="<?php echo $result['UnitPrice']; ?>">

                </div>
                <div class="mb-3">
                    <label for="fullname" class="form-label">Unit In stock</label>
                    <input type="text" class="form-control" id="unitInstock" name="unitInstock"
                        value="<?php echo $result['UnitsInStock']; ?>">

                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <!-- <a class="btn btn-primary" href="profile.php?userid=<?php //echo $result['user_id']; 
                                                                            ?>" role="button">Cancel</a> -->

                <a class="btn btn-primary" href="profile.php>" role="button">Cancel</a>
            </form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>