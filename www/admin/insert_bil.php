<?php
session_start();
if (isset($_SESSION["aid"])) {
    $aid = $_SESSION["aid"];

    if (isset($_GET["room_id"])) {
        $room_id = $_GET["room_id"];
        $month = $_GET["monthS"] . "-01";
        $leases_id = $_GET["leases_id"];
        $rid = $_GET["rid"];
        ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ออกบิล</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        $sql_invoice_berfor_meter = "SELECT * FROM invoice i 
                                     WHERE i.leases_id=$leases_id 
                                     ORDER BY i.invoice_id DESC LIMIT 1";

        $result = mysqli_query($conn, $sql);
        $result_invoice_berfor_meter = mysqli_query($conn, $sql_invoice_berfor_meter);

        $row_invoice_berfor_meter = mysqli_fetch_assoc($result_invoice_berfor_meter);

        $meter_berfor_w = 0;
        $meter_berfor_e = 0;
        
        if (mysqli_num_rows($result_invoice_berfor_meter) > 0) { 
               $meter_berfor_w = $row_invoice_berfor_meter["meters_wnew"];
               $meter_berfor_e = $row_invoice_berfor_meter["meters_lnew"];
        }  
 

        // echo($meter_berfor_w);
        // echo($meter_berfor_e);

        $l_rent =0;
        $l_c_w =0;
        $l_c_e=0;

        while ($row = mysqli_fetch_assoc($result)) {

               $l_rent =  $row["l_rent"] ;
               $l_c_w =$row["l_c_w"] ;
               $l_c_e=$row["l_c_e"] ;

            ?>
                            <form method="post" action="">
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">มิเตอร์น้ำก่อนหน้า </label>
                                        <input type="number" readonly min="0" value='<?=$meter_berfor_w;?>' required
                                            class="form-control" id="inputEmail4">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">มิเตอร์ไฟก่อนหน้า</label>
                                        <input type="number" readonly min="0" value='<?=$meter_berfor_e;?>' required
                                            class="form-control" id="inputPassword4">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">มิเตอร์น้ำล่าสุด </label>
                                        <input type="number" min="0" name="meters_wnew" v-model="meters_wnew"
                                            @keyup="sumUnit_w" @change="sumUnit_w" required class="form-control"
                                            id="inputEmail4">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">มิเตอร์ไฟล่าสุด</label>
                                        <input type="number" @keyup="sumUnit_e" @change="sumUnit_e" min="0"
                                            name="meters_lnew" v-model="meters_lnew" required class="form-control"
                                            id="inputPassword4">
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
                                        <input type="text" v-model="water_unit" name="water_unit" readonly required
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">จำนวนไฟที่ใช้</label>
                                        <input type="number" v-model="light_unit" name="light_unit" readonly required
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">รวมค่าน้ำ</label>
                                        <input type="number" v-model="total_wprice" name="total_wprice" readonly
                                            required class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">รวมค่าไฟ</label>
                                        <input type="number" name="total_lprice" v-model="total_lprice" readonly
                                            required class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">ค่าเช่า</label>
                                        <input type="number" name="l_rent" v-model="l_rent" readonly required
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">ค่าเช่าห้องพักรวมสุทธิ</label>
                                        <input type="number" name="net_total" v-model="net_total" readonly required
                                            class="form-control">
                                    </div>
                                </div>
                                <button type="submit" name="insertSubmit" class="btn btn-primary">บันทึก</button>
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
        include_once "./function.php";

        if (isset($_POST["insertSubmit"])) {
 
            
            if($_POST["water_unit"] < 0 || $_POST["light_unit"] < 0 ){
                  $month=  $_GET["monthS"];
                  $l = "insert_bil.php?monthS=$month&room_id=$room_id&rid=$rid&leases_id=$leases_id";
                 echo
                    "<script> 
                    Swal.fire({
                        icon: 'error',
                        title: 'บันทึกหน่วยน้ำหรือหรือหน่วยไฟฟ้าไม่ถูกต้อง', 
                    }).then(()=> location = '$l')
                </script>";
            }else{
                  $sql = "INSERT INTO `invoice` (`invoice_id`, `aid`, `invoice_date`, `meters_wnew`,
                    `meters_lnew`, `water_unit`, `light_unit`, `total_wprice`, `total_lprice`,
                     `net_total`, `Invoice_status`, `leases_id`, `invoice_month`, `pay_id`)
                    VALUES (NULL, '$aid', current_timestamp(), '" . $_POST["meters_wnew"] . "', '" . $_POST["meters_lnew"] . "',
                    '" . $_POST["water_unit"] . "', '" . $_POST["light_unit"] . "', '" . $_POST["total_wprice"] . "',
                     '" . $_POST["total_lprice"] . "',  '" . $_POST["net_total"] . "', '0',
                      '$leases_id', '$month', '0');";

                if (mysqli_query($conn, $sql)) {

                    echo "<script>";
                    echo "alert('บันทึกข้อมูลเรียบร้อย');";
                    echo "</script>";

                    echo "<script>";
                    echo "location = './data_bil.php';";
                    echo "</script>";

                } else {
                    echo "<script>";
                    echo "alert('ไม่สามารถบันทึกข้อมูลได้');";
                    echo "</script>";
                }
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
        data: () => ({
            message: "ok",
            meters_wnew: 0,
            meters_lnew: 0,
            meter_berfor_w: '<?=$meter_berfor_w?>',
            meter_berfor_e: '<?=$meter_berfor_e?>',
            l_c_e: '<?=$l_c_e;?>',
            l_c_w: '<?=$l_c_w;?>',
            water_unit: 0,
            light_unit: 0,
            total_wprice: 0,
            total_lprice: 0,
            l_rent: '<?=$l_rent;?>',
            net_total: 0
        }),
        methods: {
            sumUnit_w() {
                this.water_unit = this.meters_wnew - this.meter_berfor_w
                this.total_wprice = this.water_unit * this.l_c_w;
                this.calculate()
                // console.log('this.meter_berfor_w', this.meter_berfor_w);
                // console.log('this.meters_wnew', this.meters_wnew);
                // console.log('this.water_unit', this.water_unit);

            },
            sumUnit_e() {
                this.light_unit = this.meters_lnew - this.meter_berfor_e;
                this.total_lprice = this.light_unit * this.l_c_e
                this.calculate()
            },
            calculate() {
                this.net_total = (Number(this.total_wprice) + Number(this.total_lprice)) + Number(this.l_rent)
            },

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