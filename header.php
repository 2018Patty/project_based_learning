<!-- ส่วนเมนู Navigator หลัก -->
<nav class="navbar navbar-expand-lg mb-4 bg-light">

    <!-- กำหนดให้เมนูใช้พื้นที่เต็มจอภาพ (มีระยะ margin ซ้าย ขวา นิดหน่อย ไม่ติดขอบ) -->
    <div class="container">

        <!-- ตำแหน่งแสดง ตรา logo หรือชื่อเว็บไซต์  -->
        <a class="navbar-brand" href="#">
            <div class="d-flex flex-column">
                <div class="titlepage">Project Based Learning</div>
                <div class="subtitle">-- 934-303 Web Programming --</div>
            </div>
        </a>

        <!-- ปุ่มแฮมเบอร์เกอร์เมนู -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- ส่วนการแสดงผลเมนู  เชื่อมต่อกับแฮมเบอร์เกอร์เมนูด้วย data-bs-target ระบุให้นำส่วนใดไปแสดงในเมนูแฮมเบอร์เกอร์ เมื่อเว็บเกิดการย่อขนาดให้เล็กลง
  -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto my-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="login.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="showproduct.php">Show Data</a>
                </li>

                <!-- if login sucessfully then show profile icon -->
                <?php
                    if (isset($_SESSION['userid'])) {
                        
                        echo
                        "<li class='nav-item dropdown'>
                            <a class='nav-link dropdown-toggle' role='button' data-bs-toggle='dropdown' aria-expanded='false' href='#'><i class='bi bi-person-circle'></i></a>
                        
                            <ul class='dropdown-menu'>
                                <li><a class='dropdown-item' href='profile.php'>Profile</a></li>
                                <li><a class='dropdown-item' href='logout.php'>logout</a></li>
                            
                            </ul>
                        </li>";

                    }

                ?>
                <!-- if user hasn't login yet then show login menu -->
                <li class="nav-item">
                    <?php
                    if (!isset($_SESSION['userid'])) {
                        echo "<a class='nav-link' href='login.php'>login</a>";
                    }

                    ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-cart2 cart"></i>

                        <?php

                        $totalItem = 0;
                        echo "
                        <span class='badge badge-warning' id='lblCartCount'>" . $totalItem  . "</span>";

                        // if (isset($_SESSION['cart'])) {
                        // $totalItem = array_sum($_SESSION['cart']);
                        // //echo "total: ". $totalItem;
                        // echo "
                        //                 <span class='badge badge-warning' id='lblCartCount'>" . $totalItem  . "</span>";
                        // }


                        ?>
                    </a>
                </li>

            </ul>

        </div>

</nav>