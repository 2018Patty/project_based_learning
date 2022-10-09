<?php
session_start();
//1.Connect DB (MySQL)
include 'connectDB.php';

$userid = "";
// if (isset($_GET['userid'])) {
//     $userid = $_GET['userid'];
$_SESSION['userid'] = "";
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];

    //3. Generate SQL Statement
    $sql = "select * from categories";

    //echo $sql;

    //4.Send SQL statement to MySQL
    $rs = $con->query($sql);

    //5. Get result from MySQL
    //print_r($rs);

    //6.Check result by counting number of rows
    $count_row = mysqli_num_rows($rs);

    //echo  "Total Category = " . $count_row;

    // if ($count_row == 1) {
    //     // echo "Found";
    //     $result = $rs->fetch_assoc();

    //     //$result['user_id']
    //     //$result['username']
    //     //$result['password']
    //     //$result['fullname']
    //     //$result['detail']
    //     //$result['picture']
    //     //print($result['detail']);
    // }
}


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'header.php' ?>
    <div class="container">
        <div class="formData mx-auto p-4 border rounded">
            <h1 class="mb-3">Product Form</h1>
            <form method="post" action="addProduct.php" enctype="multipart/form-data">

                <!-- In-line form-control -->
                <!-- <div class="mb-3 row">
                    <label for="productName" class="col-sm-4  col-form-label">Product Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="productName" name="productName" value="">
                    </div>

                </div> -->
                <div class="mb-3">
                    <label for="productName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="productName" value="">
                </div>
                <div class="mb-3">
                    <label for="unitPrice" class="form-label">Unit Price</label>
                    <input type="text" class="form-control" id="unitPrice" name="unitPrice" value="">
                </div>
                <div class="mb-3">
                    <label for="unitInStock" class="form-label">Unit in Stock</label>
                    <input type="text" class="form-control" id="unitInStock" name="unitInStock" value="">
                </div>


                <div class="mb-3">
                    <label for="fileUpload" class="form-label">Upload Product Picture</label>
                    <input class="form-control" type="file" id="formFile" name="picfile">
                </div>

                <?php
                if ($count_row > 1) {
                    echo "<div class='mb-3'>";
                    echo "<label for='categoryID' class='form-label'>Category Name</label>";

                    echo "<select class='form-select' aria-label='Default select example' name='categoryID'>";
                    while ($result = $rs->fetch_assoc()) {
                        echo
                        "<option value='{$result['CategoryID']}'>{$result['CategoryName']}</option>";
                    }

                    echo "</select>";
                    echo "</div>";
                }
                ?>




                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-danger">Cancel</button>



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