<?php
session_start();
if (isset($_SESSION["aid"])) {
    $d = date("Y-m-d");

    ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>เพิ่มกระดานข่าว</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                <?php
include_once "./navbar.php";
    ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"> </h1>
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ฟอร์มเพิ่มข่าว</h6>
                        </div>
                        <div class="card-body">
                            <form action method="POST">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">วันที่เเจ้งข่าว </label>
                                        <input type="date" value="<?=$d?>" name="news_date" required
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputPassword4">หัวข้อข่าว</label>
                                        <input type="text" required name="news_title" class="form-control"
                                            id="inputPassword4">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputAddress">รายละเอียด</label>
                                        <textarea class="form-control" name="description" rows="6"></textarea>
                                    </div>
                                </div>
                                <button type="submit" name="InsertNewSubmit" class="btn btn-primary">บันทึก</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php
include_once "./configs/connectDB.php";
    if (isset($_POST["InsertNewSubmit"])) {
        $sql = "INSERT INTO `news` (`news_id`, `aid`, `news_title`, `description`, `news_date`)
        VALUES (NULL, '" . $_SESSION["aid"] . "', '" . $_POST["news_title"] . "', '" . $_POST["description"] . "', '" . $_POST["news_date"] . "');";

        if (mysqli_query($conn, $sql)) {
            echo "<script>";
            echo "alert('เเจ้งข่าวเรียบร้อย');";
            echo "</script>";

            echo "<script>";
            echo "location = './data_new.php';";
            echo "</script>";

        } else {
            echo "<script>";
            echo "alert('ไม่สามารถเเจ้งข่าวได้');";
            echo "</script>";
        }

    }

    ?>

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

} else {
    echo "<script>";
    echo "location = './login.php';";
    echo "</script>";

}
?>