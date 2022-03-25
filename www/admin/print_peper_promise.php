<?php
session_start();
if (isset($_SESSION["aid"])) {
    $aid = $_SESSION["aid"];
    if (isset($_GET["room_id"]) && isset($_GET["rid"]) && isset($_GET["leases_id"])) {
        $room_id = $_GET["room_id"];
        $rid = $_GET["rid"];
        $leases_id = $_GET["leases_id"];

        include "./configs/connectDB.php";
        $sql = "SELECT * FROM leases l
                              JOIN renter ren USING(rid)
                              JOIN room r USING(room_id)
                              JOIN roomtype ro USING(room_tid)
                              WHERE l.leases_id='$leases_id' AND ren.rid='$rid' AND r.room_id='$room_id'";

        $sql2 =    "SELECT * FROM leases l
                              JOIN renter ren USING(rid)
                              JOIN room r USING(room_id)
                              JOIN roomtype ro USING(room_tid)
                              WHERE l.leases_id='$leases_id' AND ren.rid='$rid' AND r.room_id='$room_id'";

        $result = mysqli_query($conn, $sql);

        $data = mysqli_fetch_assoc($result);

    //  echo  var_dump($data)  ;

        ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-print-css/css/bootstrap-print.min.css"
        media="print">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <title>พิมพ์เลขที่สัญญาที่ <?=$leases_id?></title>

    <script>
    window.print()
    </script>

    <style>
    body {
        width: 230mm;
        height: 100%;
        margin: 0 auto;
        padding: 0;
        font-size: 12pt;
        background: rgb(204, 204, 204);
    }

    * {
        font-family: 'Sarabun', sans-serif;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .main-page {
        width: 210mm;
        min-height: 297mm;
        margin: 10mm auto;
        background: white;
        box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
    }

    .sub-page {
        padding: 1cm;
        height: 297mm;
    }

    .h1-p {
        font-size: 20px;
    }

    .h2-p {
        font-size: 16px;
    }

    .bd-m {
        margin-top: 1.5cm;
        margin-bottom: 1.5cm;
        margin-left: 1.5cm;
        margin-right: 1.5cm;
    }


    @page {
        size: A4;
        margin: 0;
    }

    @media print {

        html,
        body {
            width: 210mm;
            height: 297mm;
        }

        .main-page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }

        .sub-page {
            padding: 1cm;
            height: 297mm;
        }

        .h1-p {
            font-size: 22px;
        }

        .h2-p {
            font-size: 18px;
        }

        .bd-m {
            margin-top: 2.5cm;
            margin-bottom: 1.5cm;
            margin-left: 1.5cm;
            margin-right: 1.5cm;
        }



    }
    </style>
</head>

<body>

    <?php 
    $date=date_create($data["leases_date"]);
    $dateDt = date_format($date,"d") ; 
    $dateM = date_format($date,"m") ;
    $dateY = date_format($date,"Y") + 543;
    include_once ("function.php");
    $mThFormat = dateThFormat($dateM);

    
    ?>



    <div class="main-page">
        <div class="sub-page">
            <div class="bd-m">

                <section>
                    <p class="text-center h1-p">สัญญาเช่าหอพัก </p>
                    <p class="text-end h2-p">วันที่ <?=$dateDt?> เดือน <?=$mThFormat?> พ.ศ. <?=$dateY?></p>
                    <p class="text-end mb-4 h2-p">เลขที่สัญญา <?=$leases_id?></p>
                    <div class="text-start h2-p">
                        <p>ข้าพเจ้า <?=$data["r_name"]?> <br> ขอทําสัญญาเช่าห้องพัก ชื่อหอ หอพักกังสดาล เลขที่ห้อง
                            <?=$data["room_id"]?> ประเภทห้อง
                            <?=$data["room_tname"]?>
                            <br>โดยข้าพเจ้ายินยอมทําตามเงื่อนไขสัญญา ดังนี้
                        </p>
                    </div>
                </section>

                <section>
                    <p class="text-start h2-p mt-4">1. ข้าพเจ้าจะอยู่ในห้องพักด้วยความสงบ ไม่กระทําการหรือยินยอม
                        ให้ผู้อื่นกระทําการใดๆ ภายในหรือภายนอกห้องเช่า อันเป็นการขัดต่อกฎหมายหรือศีลธรรมอันดี
                        หรือเป็นที่เดือด ร้อน</p>
                    <p class="text-start h2-p mt-4">2. ข้าพเจ้าจะอยู่ในห้องพักด้วยความสงบ ไม่กระทําการหรือยินยอม
                        ให้ผู้อื่นกระทําการใดๆ ภายในหรือภายนอกห้องเช่า อันเป็นการขัดต่อกฎหมายหรือศีลธรรมอันดี
                        หรือเป็นที่เดือด ร้อน</p>
                    <p class="text-start h2-p mt-4">3. ข้าพเจ้าจะอยู่ในห้องพักด้วยความสงบ ไม่กระทําการหรือยินยอม
                        ให้ผู้อื่นกระทําการใดๆ ภายในหรือภายนอกห้องเช่า อันเป็นการขัดต่อกฎหมายหรือศีลธรรมอันดี
                        หรือเป็นที่เดือด ร้อน</p>
                    <p class="text-start h2-p mt-4">เงื่อนไขการชําระ</p>
                    <section class="" style="margin-left: 50px;">
                        <p class="text-start h2-p mr-5">
                            - ค่ามัดจํา 2 เดือน (จ่ายในวันที่ทําสัญญาเท่านั้น) <br>
                            - ต้องชําระค่าที่พักอาศัยภายในวันที่ 1 - 5 ของทุกเดือน (ถ้าจ่ายช้า ปรับวันละ 50 บาท) <br>
                            - รายละเอียดดังนี้ ค่าที่พักอาศัย
                        <section class="" style="margin-left: 50px;">
                            <p>
                                <li>ห้องแอร์ 5000 บาท</li>
                            </p>
                            <p>
                                <li>ห้องพัดลม 3000 บาท</li>
                            </p>
                            <p>
                                <li>ค่าน้ำ หน่วยละ 20 บาท</li>
                            </p>
                            <p>
                                <li>ค่าไฟ หน่วยละ 9 บาท</li>
                            </p>
                        </section>
                        </p>
                    </section>

                    <section>
                        <p class="text-end h2-p">ข้าพเจ้าขอยืนยันว่าสัญญาฉบับนี้เป็นความจริงทั้งหมดทุกประการ</p>
                        <p class="text-end h2-p">ลงชื่อ ................................................. ผู้เช่า</p>
                        <p class="text-end h2-p"><span class=""
                                style="margin-right: 1rem;">(........................................................)</span>
                        </p>
                        <p class="text-end h2-p">ลงชื่อ ............................................... พยาน</p>
                        <p class="text-end h2-p"><span class=""
                                style="margin-right: 1rem;">(........................................................)</span>
                        </p>
                        <p class="text-end h2-p" style="margin-right: 4rem;">.........../.........../...........</p>
                    </section>

                </section>

            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
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