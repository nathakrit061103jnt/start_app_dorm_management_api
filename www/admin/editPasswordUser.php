<?php
session_start();
if (isset($_SESSION["aid"])) {
    $aid = $_SESSION["aid"];
    if (isset($_GET["room_id"]) && isset($_GET["rid"]) && isset($_GET["leases_id"])) {
        $room_id = $_GET["room_id"];
        $rid = $_GET["rid"];
        $leases_id = $_GET["leases_id"];

        ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">เปลี่ยนรหัสผ่าน</h1>
                                    </div>
                                    <form class="user" method="post" action="">
                                        <!-- <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div> -->
                                        <div class="form-group">
                                            <input type="password" required class="form-control form-control-user"
                                                id="exampleInputPassword" name="newPassword" placeholder="รหัสผ่านใหม่">
                                        </div>
                                        <button type="submit" name="editPassword"
                                            class="btn btn-primary btn-user btn-block">
                                            เปลี่ยนรหัสผ่าน
                                        </button>
                                        <hr>
                                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>
                                    <!-- <hr> -->
                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
if (isset($_POST["editPassword"])) {

            include_once "./configs/connectDB.php";

            $password = md5($_POST["newPassword"]);
            $sql = "UPDATE `renter` SET `password` = '$password' WHERE `renter`.`rid` = '$rid';";

            if (mysqli_query($conn, $sql)) {

                echo "<script>";
                echo "alert('เเก้ไขรหัสผ่านเรียบร้อย');";
                echo "</script>";

                echo "<script>";
                echo "location = './edit_less.php?room_id=$room_id&rid=$rid&leases_id=$leases_id'";
                echo "</script>";

            } else {
                echo "<script>";
                echo "alert('ไม่สามารถเเก้ไขรหัสผ่านได้');";
                echo "</script>";
            }

        }
        ?>



            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
<?php
}
} else {
    echo "<script>";
    echo "location = './login.php';";
    echo "</script>";

}
?>