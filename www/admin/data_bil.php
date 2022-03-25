<?php
session_start();
if (isset($_SESSION["username"])) {
    $month;
    if (isset($_GET["monthS"])) {
        $month = $_GET["monthS"];
    } else {
        $month = date("Y-m");
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>บิล</title>

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
                    <h1 class="h3 mb-2 text-gray-800">บิลทั้งหมด</h1><br>

                    <p class="mb-4">รายละเอียดเลขที่สัญญา</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md">
                                    <h6 class="m-0 font-weight-bold txt-color">เลขที่สัญญา</h6>
                                </div>
                                <div class="col-8">
                                    <form method="get"
                                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                        <div class="input-group">
                                            <label for="" class="mr-3">เดือน </label>
                                            <div class="form-group">
                                                <input type="month" class="form-control" name="monthS" id=""
                                                    aria-describedby="helpId" placeholder="" value="<?=$month?>">
                                            </div>
                                            <div class="input-group-append">
                                                <button class="btn button-color" type="submit">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- <a href="add_room.php" type="button" class="btn btn-primary mb-3">เพิ่มเลขที่สัญญา</a> -->
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>หมายเลขที่ห้อง</th>
                                            <th>ประเภทห้องพัก</th>
                                            <!-- <th>สถานะ</th> -->
                                            <th>ชื่อผู้เช่า</th>
                                            <th></th>
                                            <th>จัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

    include "./configs/connectDB.php";

    $sql = "SELECT * FROM leases l JOIN room r USING(room_id) JOIN renter ren USING(rid)
             JOIN roomtype rt USING(room_tid) WHERE r.room_status=1";

    $result = mysqli_query($conn, $sql);

    $sql1 = "SELECT * FROM invoice i JOIN leases l USING(leases_id)
             JOIN renter ren USING(rid) JOIN room r USING(room_id) JOIN roomtype rt USING(room_tid) WHERE r.room_status=1";

    include "./function.php";
    $result1 = mysqli_query($conn, $sql1);

    while ($data = mysqli_fetch_assoc($result)) {
        ?>
                                        <tr>
                                            <td><?=$data["room_id"]?></td>
                                            <td><?=$data["room_tname"]?></td>
                                            <td><?=$data["r_name"]?></td>
                                            <td>
                                                <?php
$check_bil = check_bil($conn, $data["leases_id"], $month);
        $check_payment = check_payment($conn, $data["leases_id"], $month);
        if ($check_bil == 0) {?>
                                                <a href="./insert_bil.php?monthS=<?=$month?>&room_id=<?=$data["room_id"]?>&rid=<?=$data["rid"]?>&leases_id=<?=$data["leases_id"]?>"
                                                    class="btn btn-sm button-color">ออกบิล
                                                </a>

                                                <?php
} else {
            if ($check_payment == 0) {
                echo "<span class='text-danger'>ยังไม่ชำระ</span>";
            } else if ($check_payment == 1) {
                echo "<span class='text-warning'>รอการยืนยัน</span>";
            } else {
                echo "<span class='text-success'>ชำระเเล้ว</span>";
            }

        }
        ?>

                                            </td>

                                            <td class="py-0 align-middle">
                                                <?php
$check_bil = check_bil($conn, $data["leases_id"], $month);
        $check_payment = check_payment($conn, $data["leases_id"], $month);
        $get_invoice_id = get_invoice_id($conn, $data["leases_id"], $month);

        if ($check_bil != 0) {

            ?>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="show_bil.php?invoice_id=<?=$get_invoice_id?>&monthS=<?=$month?>&room_id=<?=$data["room_id"]?>&rid=<?=$data["rid"]?>&leases_id=<?=$data["leases_id"]?>"
                                                        class="btn btn-info"><i class="fas fa-eye"></i>
                                                    </a>
                                                    <?php
if ($check_payment == 0) {
                ?>
                                                    <a href="./edit_bil.php?invoice_id=<?=$get_invoice_id?>&monthS=<?=$month?>&room_id=<?=$data["room_id"]?>&rid=<?=$data["rid"]?>&leases_id=<?=$data["leases_id"]?>"
                                                        class="btn btn-warning"><i class="fas fa-edit"></i>
                                                    </a>
                                                    <button
                                                        onclick="delete_invoice('<?=$get_invoice_id?>','<?=$month?>' )"
                                                        class="btn btn-danger"><i class="fas fa-trash"></i>
                                                    </button>
                                                    <?php
} elseif ($check_payment == 1) {
                ?>
                                                    <a href="./edit_status_bil.php?invoice_id=<?=$get_invoice_id?>&monthS=<?=$month?>&room_id=<?=$data["room_id"]?>&rid=<?=$data["rid"]?>&leases_id=<?=$data["leases_id"]?>"
                                                        class="btn button-color"><i class="fas fa-adjust"></i></i>
                                                    </a>

                                                    <?php
}
            ?>
                                                </div>

                                                <?php
}
        ?>

                                            </td>
                                        </tr>

                                        <?php
}

    ?>

                                    </tbody>
                                </table>
                            </div>
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
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn button-color" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    function delete_invoice(invoice_id, month) {
        let r = confirm("ต้องการข้อมูลหรือไม่!");
        if (r == true) {
            location = `./data_bil.php?delete_invoice=req&invoice_id=${invoice_id}&monthS=${month}`;
        } else {
            location = `./data_bil.php?monthS=${month}`;
        }
        console.log('room_id', room_id)
    }
    </script>

    <?php
if (isset($_GET["delete_invoice"]) && isset($_GET["invoice_id"]) && isset($_GET["monthS"])) {

        $invoice_id = $_GET["invoice_id"];
        $month = $_GET["monthS"];
        $sqlD = "DELETE FROM `invoice` WHERE `invoice`.`invoice_id` = '$invoice_id'";

        if (mysqli_query($conn, $sqlD)) {
            // echo "<script>";
            // echo "alert('ลบข่าวเรียบร้อย');";
            // echo "</script>";

            echo "<script>";
            echo "location = './data_bil.php?monthS=$month';";
            echo "</script>";

        } else {

            echo "<script>";
            echo "alert('ไม่สามารถข้อมูลได้');";
            echo "</script>";

            echo "<script>";
            echo "location = './data_bil.php?monthS=$month';";
            echo "</script>";

        }

    }
    ?>

    <script>
    $('#dataTable').dataTable({
        "order": [
            [0, 'desc']
        ]
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
} else {
    echo "<script>";
    echo "location = './login.php';";
    echo "</script>";
}
?>