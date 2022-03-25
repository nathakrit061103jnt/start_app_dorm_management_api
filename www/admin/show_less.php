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

    <title>ข้อมูลสัญญา</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">

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
                    <h1 class="h3 mb-2 text-gray-800">เลขที่สัญญา <?=$leases_id?></h1>
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold txt-color">ข้อมูลสัญญาเช่า</h6>
                        </div>
                        <div class="card-body">
                            <?php
include "./configs/connectDB.php";
        $sql = "SELECT * FROM leases l
                              JOIN renter ren USING(rid)
                              JOIN room r USING(room_id)
                              WHERE l.leases_id='$leases_id' AND ren.rid='$rid' AND r.room_id='$room_id'";

        $result = mysqli_query($conn, $sql);

        while ($data = mysqli_fetch_assoc($result)) {
            ?>

                            <form method="post" action="">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">วันเริ่มสัญญา</label>
                                        <h6 class="txt-color ml-3"><?=$data["leases_date"]?></h6>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">วันสิ้นสุดสัญญา</label>
                                        <h6 class="txt-color ml-3"><?=$data["expires_date"]?></h6>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">ชื่อ-นามสกุล</label>
                                        <h6 class="txt-color ml-3"><?=$data["r_name"]?></h6>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">เลขที่บัตรประชาชน</label>
                                        <h6 class="txt-color ml-3"><?=$data["r_idcard"]?></h6>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">เบอร์โทรศัพท์</label>
                                        <h6 class="txt-color ml-3"><?=$data["r_tel"]?></h6>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">อีเมล</label>
                                        <h6 class="txt-color ml-3"><?=$data["r_email"]?></h6>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputAddress">ที่อยู่</label>
                                        <h6 class="txt-color ml-3"><?=$data["r_add"]?></h6>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">ชื่อผู้ใช้</label>
                                        <h6 class="txt-color ml-3"><?=$data["username"]?></h6>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">ค่าไฟต่อหน่วย</label>
                                        <h6 class="txt-color ml-3"><?=$data["l_c_e"]?></h6>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">ค่าน้ำต่อหน่วย</label>
                                        <h6 class="txt-color ml-3"><?=$data["l_c_w"]?></h6>
                                    </div>

                                </div>
                                <a href="./print_peper_promise.php?room_id=<?=$room_id?>&rid=<?=$rid?>&leases_id=<?=$leases_id?>"
                                    class="btn button-color" target="_bank">พิมพ์สัญญาเช่า</a>
                            </form>
                            <?php
}

        ?>
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

        if (isset($_POST["editSubmit"])) {

            $sql = "UPDATE `renter` SET `r_tel` = '" . $_POST["r_tel"] . "',r_name='" . $_POST["r_name"] . "',
            r_idcard='" . $_POST["r_idcard"] . "',r_add='" . $_POST["r_add"] . "',r_email='" . $_POST["r_email"] . "'
            ,username='" . $_POST["username"] . "'
             WHERE `renter`.`rid` = '$rid';";

            if (mysqli_query($conn, $sql)) {

                $sql1 = "UPDATE `leases` SET `leases_date` = '" . $_POST["leases_date"] . "',
                        expires_date='" . $_POST["expires_date"] . "',
                        l_c_w='" . $_POST["l_c_w"] . "',l_c_e='" . $_POST["l_c_e"] . "'
                        WHERE `leases`.`leases_id` = '$leases_id';";

                if (mysqli_query($conn, $sql1)) {
                    echo "<script>";
                    echo "alert('เเก้ไขข้อมูลเรียบร้อย');";
                    echo "</script>";

                    echo "<script>";
                    echo "location = './data_leases.php';";
                    echo "</script>";

                } else {
                    echo "<script>";
                    echo "alert('ไม่สามารถเเก้ไขข้อมูลได้');";
                    echo "</script>";
                }

            } else {
                echo "<script>";
                echo "alert('ไม่สามารถเเก้ไขข้อมูลได้');";
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
                    <a class="btn button-color" href="login.html">Logout</a>
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