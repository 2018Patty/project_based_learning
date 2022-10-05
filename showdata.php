<?php
session_start();

//1.Connect DB (MySQL)
include 'connectDB.php';

//3. Generate SQL Statement
$sql = "select * from users";

// echo $sql;

//4.Send SQL statement to MySQL
$rs = $con->query($sql);

//5. Get result from MySQL
// print_r($rs);

//6.Check result by counting number of rows
$count_row = mysqli_num_rows($rs);

//echo $count_row;


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
        <?php
        if ($count_row > 0) {

        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">รหัสลูกค้า</th>
                    <th scope="col">Username</th>
                    <th scope="col">ชื่อ-นามสกุล</th>
                    <th scope="col">รายละเอียด</th>
                    <th scope="col">รูปสมาชิก</th>
                    <th scope="col">แก้ไข</th>
                    <th scope="col">ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($result = $rs->fetch_assoc()) {
                        // echo "hi";
                        // print_r($result['user_id']);
                    ?>
                <tr>
                    <td><?php echo $result['user_id']; ?></td>
                    <td><?php echo $result['username']; ?></td>
                    <td><?php echo $result['fullname']; ?></td>
                    <td><?php echo $result['detail']; ?></td>
                    <td>
                        <img src="images/<?php echo $result['picture']; ?>" class="img-thumbnail" alt="...">
                    </td>
                    <td><a class="btn btn-primary" href="#" role="button">Update</a></td>
                    <td><a class="btn btn-danger" href="#" role="button">Delete</a></td>
                </tr>
                <?php
                    }
                    ?>
            </tbody>
        </table>
        <?php
        }
        ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>