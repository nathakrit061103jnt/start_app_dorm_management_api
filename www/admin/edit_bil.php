<?php
session_start();
if (isset($_SESSION["aid"])) {
    $aid = $_SESSION["aid"];
    if (isset($_GET["room_id"]) && isset($_GET["invoice_id"])) {
        $room_id = $_GET["room_id"];
        $month = $_GET["monthS"] . "-01";
        $leases_id = $_GET["leases_id"];
        $rid = $_GET["rid"];
        $invoice_id = $_GET["invoice_id"];
        ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>เเก้ไขออกบิล</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

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
                <div class="container-fluid" id="app">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">ห้อง <?=$room_id?></h1>
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">บิลค่าเช่าประจำเดือน
                                <?php
$date = date_create($month);
        echo date_format($date, "M-Y");?></h6>
                        </div>
                        <div class="card-body">
                            <?php

        include "./configs/connectDB.php";
        include "./function.php";
        $get_meter_before = get_meter_before($conn, $leases_id, $month);
        $meters_before_wnew = $get_meter_before["0"];
        $meters_before_lnew = $get_meter_before["1"];
        $sql = "SELECT * FROM leases l WHERE l.aid='$aid'
                AND l.room_id='$room_id' AND l.leases_id='$leases_id'
                AND l.rid='$rid';";

        $result = mysqli_query($conn, $sql);

        $sql1 = "SELECT * FROM invoice WHERE invoice_id='$invoice_id'";
        $result1 = mysqli_query($conn, $sql1);

        while ($row = mysqli_fetch_assoc($result)) {
            while ($data = mysqli_fetch_assoc($result1)) {
                ?>
                            <form method="post" action="">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">มิเตอร์น้ำล่าสุด </label>
                                        <input type="number" min="0" name="meters_wnew"
                                            value='<?=$data["meters_wnew"]?>' required class="form-control"
                                            id="inputEmail4">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">มิเตอร์ไฟล่าสุด</label>
                                        <input type="number" min="0" value='<?=$data["meters_lnew"]?>'
                                            name="meters_lnew" required class="form-control" id="inputPassword4">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">ค่าน้ำต่อหน่วย</label>
                                        <input type="text" readonly name="l_c_w" value='<?=$row["l_c_w"]?>' required
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">ค่าไฟต่อหน่วย</label>
                                        <input type="text" name="l_c_e" value='<?=$row["l_c_e"]?>' readonly required
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">จำนวนน้ำที่ใช้</label>
                                        <input type="text" value='<?=$data["water_unit"]?>' name="water_unit" required
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">จำนวนไฟที่ใช้</label>
                                        <input type="number" value='<?=$data["light_unit"]?>' name="light_unit" required
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">รวมค่าน้ำ</label>
                                        <input type="number" value='<?=$data["total_wprice"]?>' name="total_wprice"
                                            required class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">รวมค่าไฟ</label>
                                        <input type="number" value='<?=$data["total_lprice"]?>' name="total_lprice"
                                            required class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">ค่าเช่า</label>
                                        <input type="number" name="l_rent" readonly value="<?=$row["l_rent"]?>" required
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">ค่าเช่าห้องพักรวมสุทธิ</label>
                                        <input type="number" value='<?=$data["net_total"]?>' name="net_total" required
                                            class="form-control">
                                    </div>
                                </div>
                                <button type="submit" name="editSubmit" class="btn btn-warning">เเก้ไข</button>
                            </form>
                            <?php
}
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
        include_once "./function.php";

        if (isset($_POST["editSubmit"])) {
            $sql_update = "UPDATE `invoice` SET invoice_date=current_timestamp(),
            meters_wnew='" . $_POST["meters_wnew"] . "' , `meters_lnew` = '" . $_POST["meters_lnew"] . "',
            water_unit='" . $_POST["water_unit"] . "' , `light_unit` = '" . $_POST["light_unit"] . "',
            total_wprice='" . $_POST["total_wprice"] . "' , `total_lprice` = '" . $_POST["total_lprice"] . "',
            net_total='" . $_POST["net_total"] . "' , `leases_id` = '$leases_id',
            invoice_month='$month'
             WHERE `invoice`.`invoice_id` = '$invoice_id';";

            if (mysqli_query($conn, $sql_update)) {

                echo "<script>";
                echo "alert('เเก้ไขข้อมูลเรียบร้อย');";
                echo "</script>";

                echo "<script>";
                echo "location = './data_bil.php';";
                echo "</script>";

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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    const app = new Vue({
        el: '#app',
        data: {
            message: 'Hello Vue!'
        }
    });
    </script>

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