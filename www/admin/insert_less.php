<?php
session_start();
if (isset($_SESSION["aid"])) {
    $aid = $_SESSION["aid"];
    if (isset($_GET["room_id"]) and isset($_GET["room_tprice"])) {
        $room_id = $_GET["room_id"];
        $room_tprice = $_GET["room_tprice"];
        $price_water = $_GET["price_water"];
        $price_light = $_GET["price_light"];
        ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ทำสัญญาเช่า</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="./style.css">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include_once "./sidebar.php";?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include_once "./navbar.php";?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">ห้อง <?=$room_id?></h1>
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold txt-color">ฟอร์มทำสัญญาเช่า</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">วันเริ่มสัญญา</label>
                                        <input type="date" name="leases_date" required class="form-control"
                                            id="inputEmail4">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">วันสิ้นสุดสัญญา</label>
                                        <input type="date" name="expires_date" required class="form-control"
                                            id="inputPassword4">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">ชื่อ-นามสกุล</label>
                                        <input type="text" name="r_name" required class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">เลขที่บัตรประชาชน</label>
                                        <input type="text" name="r_idcard" required class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">เบอร์โทรศัพท์</label>
                                        <input type="text" name="r_tel" required class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">อีเมล</label>
                                        <input type="email" name="r_email" required class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputAddress">ที่อยู่</label>
                                        <textarea class="form-control" name="r_add" required id="" rows="5"></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">ชื่อผู้ใช้</label>
                                        <input type="text" name="username" required class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">รหัสผ่าน</label>
                                        <input type="password" name="password" required class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">ค่าไฟต่อหน่วย</label>
                                        <input type="text" name="l_c_e" required class="form-control"
                                            value="<?=$price_water?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">ค่าน้ำต่อหน่วย</label>
                                        <input type="text" name="l_c_w" required class="form-control"
                                            value="<?=$price_light?>">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputAddress">ค่าเช่า</label>
                                        <input type="text" name="l_rent" required class="form-control"
                                            value="<?=$room_tprice?>">
                                    </div>
                                </div>
                                <button type="submit" name="insertSubmit" class="btn button-color">บันทึก</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
include_once "./footer.php";
        ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

        <?php
include_once "./configs/connectDB.php";
        include_once "./function.php";

        if (isset($_POST["insertSubmit"])) {
            $password = md5($_POST["password"]);
            $sql = "INSERT INTO `renter` (`rid`, `r_name`, `r_tel`, `r_idcard`, `r_add`, `r_email`, `username`, `password`)
                    VALUES (NULL, '" . $_POST["r_name"] . "', '" . $_POST["r_tel"] . "', '" . $_POST["r_idcard"] . "',
                            '" . $_POST["r_add"] . "', '" . $_POST["r_email"] . "', '" . $_POST["username"] . "',
                            '$password');";

            if (mysqli_query($conn, $sql)) {

                $findOne_asc = findOne_asc($conn);

                $sql1 = "INSERT INTO `leases` (`leases_id`, `aid`, `rid`, `room_id`, `leases_date`, `expires_date`, `leases_status`,`l_c_e`,`l_c_w`,`l_rent`)
                        VALUES (NULL, '$aid', '$findOne_asc','$room_id', '" . $_POST["leases_date"] . "', '" . $_POST["expires_date"] . "', '1',
                        '" . $_POST["l_c_e"] . "', '" . $_POST["l_c_w"] . "', '" . $_POST["l_rent"] . "');";
                $update_s_room = update_s_room($conn, $room_id);
                if (mysqli_query($conn, $sql1) && $update_s_room == 1) {
                    echo "<script>";
                    echo "alert('บันทึกข้อมูลเรียบร้อย');";
                    echo "</script>";

                    echo "<script>";
                    echo "location = './data_room.php';";
                    echo "</script>";

                } else {
                    echo "<script>";
                    echo "alert('ไม่สามารถบันทึกข้อมูลได้');";
                    echo "</script>";
                }

            } else {
                echo "<script>";
                echo "alert('ไม่สามารถบันทึกข้อมูลได้');";
                echo "</script>";
            }

        }
        ?>

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

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