<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'header.php' ?>
    <div class="container">
        <div class="login mx-auto p-4 border rounded">
            <h1 class="mb-3">Register Member</h1>
            <form method="post" action="addUser.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="">

                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="">

                </div>
                <div class="mb-3">
                    <label for="fullname" class="form-label">Fullname</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" value="">

                </div>
                <div class="mb-3">
                    <label for="detail" class="form-label">Address</label>
                    <textarea class="form-control" id="detail" rows="3" name="address"></textarea>
                </div>
                <!-- <input type="hidden" name="userid" value="<?php
                                                                //echo $result['user_id'];
                                                                ?>"> -->
                <div class="mb-3">
                    <label for="fileUpload" class="form-label">Upload Profile Picture</label>
                    <input class="form-control" type="file" id="formFile" name="picfile">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
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