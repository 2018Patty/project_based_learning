<?php
session_start();

//1.Connect DB (MySQL)
include 'connectDB.php';



//3. Generate SQL Statement
$sql = "select * from products";

// echo $sql;

//4.Send SQL statement to MySQL
$rs = $con->query($sql);

//5. Get result from MySQL
// print_r($rs);

//6.Check result by counting number of rows
$count_row = mysqli_num_rows($rs);

//echo $count_row;

if (isset($_GET['n'])) {
    $n = $_GET['n'];
} else {
    $n = 1;
}

$itemsPerPage = 10;
$numPages = ceil($count_row / $itemsPerPage);

$start = ($n - 1) * $itemsPerPage;

// echo "<br>Total data: " . $count_row;
// echo "<br>Page no. " . $n;
// echo "<br>Start " . $start;
// echo "<br>Number of pages: " . $numPages;

/*
    select_list
    FROM 
        table_name
    ORDER BY 
        sort_expression
    LIMIT offset, row_count;
    ex. select * from products limit 12, 3
    หมายความว่า ให้แสดงข้อมูลสินค้า ลำดับที่ 13 โดยแสดง 3 records
    */

$sql2 = "select * from products p, categories c where p.CategoryID = c.CategoryID limit {$start},  {$itemsPerPage}";
// echo $sql2;
$result2 = $con->query($sql2);
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
                    <th scope="col">รหัสสินค้า</th>
                    <th scope="col">ชื่อสินค้า</th>
                    <th scope="col">ราคาต่อหน่วย</th>
                    <th scope="col">จำนวนคงเหลือ</th>

                    <th scope="col">แก้ไข</th>
                    <th scope="col">ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($result = $result2->fetch_assoc()) {
                        // echo "hi";
                        // print_r($result['user_id']);
                    ?>
                <tr>
                    <td><?php echo $result['ProductID']; ?></td>
                    <td><?php echo $result['ProductName']; ?></td>
                    <td><?php echo $result['UnitPrice']; ?></td>
                    <td><?php echo $result['UnitsInStock']; ?></td>
                    <!-- <td>
                        <img src="images/<?php //echo $result['picture']; 
                                            ?>" class="img-thumbnail2" alt="...">
                    </td> -->
                    <td><a class="btn btn-primary" href="editproduct.php?productid=<?php echo $result['ProductID']; ?>"
                            role="button">Update</a></td>
                    <td><a class="btn btn-danger" href="deleteProduct.php?productid=<?php echo $result['ProductID']; ?>"
                            role="button"
                            onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
                </tr>
                <?php
                    }
                    ?>
            </tbody>
        </table>
        <?php
        }
        ?>
        <nav aria-label="Page navigation example">
            <ul class=" pagination justify-content-end">
                <?php
                if ($n > 1) {
                    echo
                    "<li class='page-item'>
                            <a class='page-link' href='showproduct.php?n=" . ($n - 1) . "'>Previous</a>
                        </li>";
                } else {
                    echo
                    "<li class='page-item'>
                            <a class='page-link' href='showproduct.php?n=1'>Previous</a>
                        </li>";
                }
                $i = 1;
                while ($i <= $numPages) {
                    echo
                    "<li class='page-item'>
                            <a class='page-link' href='showproduct.php?n=" . $i . "'>" . $i . "</a>
                        </li>";
                    $i++;
                }
                if ($n < $numPages) {
                    echo
                    "<li class='page-item'>
                                <a class='page-link' href='showproduct.php?n=" .  ($n + 1) . "'>Next</a>
                            </li>";
                } else {
                    echo
                    "<li class='page-item'>
                                <a class='page-link' href='showproduct.php?n=" . $numPages  . "'>Next</a>
                            </li>";
                }
                ?>
            </ul>
        </nav>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>