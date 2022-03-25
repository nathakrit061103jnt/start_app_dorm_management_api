<?php
session_start();
unset($_SESSION["username"]);
unset($_SESSION["a_name"]);
unset($_SESSION["a_tel"]);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>เข้าสู่ระบบ ผู้ดูเเลหอพัก</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .bg-p{
            background-color: coral;
        }
        .button-color{
            background-color: coral;
             border: coral;
             color:white;
        }
        .txt-color{
            color:coral;
        }
    </style>

</head>

<body class="bg-p">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block  ">

                                <img src="./img/two-factor-authentication-pana.svg" class="img-fluid" alt="" srcset="">

                            </div>
                            <div class="col-lg-6 mt-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4  mb-4 txt-color">เข้าสู่ระบบ ผู้ดูเเลหอพัก</h1>
                                    </div>
                                    <form class="user" action="" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" name="username" aria-describedby="emailHelp"
                                                placeholder="ชื่อผู้ใช้งาน" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                placeholder="รหัสผ่าน" required>
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        <button type="submit" name="loginSubmit"
                                            class="btn button-color text-white btn-user btn-block">
                                            เข้าสู่ระบบ
                                        </button>
                                        <!-- <hr> -->
                                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a> -->
                                        <!-- <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>
                                    <!-- <hr> -->
                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">ลืมรหัสผ่าน?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">เพิ่ม Admin!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php
if (isset($_POST["loginSubmit"])) {
    include_once "./configs/connectDB.php";

    $sql = "SELECT * FROM admin a WHERE a.username='" . $_POST["username"] . "'
        AND a.password='" . $_POST["password"] . "' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (@mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_assoc($result)) {
            $_SESSION["username"] = $data["username"];
            $_SESSION["a_name"] = $data["a_name"];
            $_SESSION["a_tel"] = $data["a_tel"];
            $_SESSION["aid"] = $data["aid"];
        }
        echo "<script>";
        echo "location = './index.php';";
        echo "</script>";

    } else {
        echo "<script>";
        echo "alert('รหัสผ่านไม่ถูกต้อง');";
        echo "</script>";

    }

    mysqli_close($conn);

}
?>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>