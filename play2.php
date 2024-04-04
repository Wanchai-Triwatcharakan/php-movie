<?php
include('connect.php');

$num_rows = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_movie")); //เช็คแถว //ใช้ดึงจำนวนแถวที่ได้จากการดำเนินการคิวรี (query) ที่ส่งไปยังฐานข้อมูล MySQL

$limit_page = 4; // 1 หน้ามีกี่เรื่อง
$page = $_GET['Page']; // เลขหน้า
$num_page = $num_rows / $limit_page; // หาจำนวนหน้าทั้งหมดของเว็บ เรื่องทั้งหมดที่มี/เรื่องต่อหน้า
if (!($num_page == (int)$num_page)) // ตรวจสอบ $num_page เป็นจำนวนเต็มหรือไม่ 
    $num_page = (int)$num_page + 1; // ปัด $num_page ขึ้น
$limit_start = ($page * $limit_page) - $limit_page; // เริ่มต้นที่หน้าไหน หน้าแรกนับ 0-7 หน้า 2 นับ 8-15
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New-Movie</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="./">New-Movie</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbardrop">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbardrop">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="./">หน้าหลัก</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                หนัง
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">หนังไทย</a></li>
                                <li><a class="dropdown-item" href="#">หนังฝรั่ง</a></li>
                                <li><a class="dropdown-item" href="#">หนังอินเดีย</a></li>
                                <li><a class="dropdown-item" href="#">หนังญี่ปุ่น</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                ซีรีย์
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">ซีรีย์ไทย</a></li>
                                <li><a class="dropdown-item" href="#">ซีรีย์ฝรั่ง</a></li>
                                <li><a class="dropdown-item" href="#">ซีรีย์เกาหลี</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">การ์ตูน</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="ค้นหา">
                        <button class="btn btn-outline-success" type="submit">ค้นหา</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <div class="overlay">
        <div class="album py-2 mt-5">
            <div class="container">
                <nav>
                    <ol class="breadcrumb px-2 py-2 mt-3 mb-3 rounded-3" style="background-color:#E1E1E1">
                        <li class="breadcrumb-item active"><a href="./" class="link-underline link-underline-opacity-0">หน้าหลัก</a></li>
                    </ol>
                </nav>
                <div class="row">
                    <?php
                    $query = mysqli_query($connect, "SELECT * FROM data_movie ORDER BY id DESC LIMIT $limit_start,$limit_page"); //ส่งคำสั่ง SQL ไปที่ MySQL database ที่ชื่อ data_movie
                    while ($result = mysqli_fetch_array($query)) { //ใช้ดึงข้อมูลจากผลลัพธ์ของคำสั่ง SQL ที่ถูกส่งไปที่ MySQL database ออกมาในรูปแบบของ array
                    ?>
                        <div class="col-sm-6 col-md-3 col-lg-3 my-2 d-flex justify-content-center">
                            <a href="./play.php?id=<?= $result['id'] ?>" class="link-underline link-underline-opacity-0">
                                <div class="card shadow-sm">
                                    <img src=<?= $result['img'] ?> width="100%" height="300vh" class="rounded card-img-top mw-75 mh-75" alt="">
                                    <div class="card-body p-2">
                                        <p class="card-text text-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $result['name'] ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <nav class="d-flex justify-content-center mt-3">
                    <ul class="pagination">
                        <!--------------------------------------------------->
                        <?php
                        if ($page <= 1) {
                        ?>
                            <li class="page-item disabled">
                                <a class="page-link">ก่อนหน้า</a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="?Page=<?= $page - 1 ?>">ก่อนหน้า</a>
                            </li>
                        <?php
                        }
                        ?>
                        <!--------------------------------------------------->
                        <?php
                        if ($page > 5) {
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="?Page=1">1</a>
                            </li>
                            <li class="page-item disabled">
                                <a class="page-link">...</a>
                            </li>
                        <?php
                        }
                        ?>
                        <!--------------------------------------------------->
                        <?php
                        // กันไม่ให้หน้าปัจจุบัน เกินหน้าสูงสุด
                        if ($page > $num_page) {
                            $page = $num_page;
                        }
                        if ($num_page >= 9) {
                            // แสดงจำนวนหน้าที่ต้องการ
                            if ($page <= 5) {
                                $num_start = 1;
                                $num_stop = 9;
                                // ไม่แสดงเลขหน้าเกิน $num_page
                            } elseif ($page > $num_page - 4) {
                                $num_start = $num_page - 8;
                                $num_stop = $num_page;
                            }
                            // แสดงเลขหน้า ก่อน และหลัง ของหน้าปัจจุบัน
                            else {
                                $num_start = $page - 4;
                                $num_stop = $page + 4;
                            }
                        }else{
                            $num_start = 1;
                            $num_stop = $num_page;
                        }

                        for ($i = $num_start; $i <= $num_stop; $i++) {
                            if ($page == $i) {
                        ?>
                                <li class="page-item active">
                                    <span class="page-link"><?= $i ?></span>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="page-item">
                                    <a class="page-link" href="?Page=<?= $i ?>"><?= $i ?></a>
                                </li>
                        <?php
                            }
                        }
                        ?>
                        <!--------------------------------------------------->
                        <?php
                        if ($page < $num_page - 4) {
                        ?>
                            <li class="page-item disabled">
                                <a class="page-link">...</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?Page=<?= $num_page ?>"><?= $num_page ?></a>
                            </li>
                        <?php
                        }
                        ?>
                        <!--------------------------------------------------->
                        <?php
                        if ($page >= $num_page) {
                        ?>
                            <li class="page-item disabled">
                                <a class="page-link">ถัดไป</a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="?Page=<?= $page + 1 ?>">ถัดไป</a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <footer class="text-body-secondary bg-dark py-3">
        <div class="container">
            <p class="mb-1 text-white text-center">ดูหนังออนไลน์ฟรี PHP & Bootstap <a href="#">New-Movie</a></p>
        </div>
    </footer>

</body>

</html>

// เรียกใช้หน้าฐาน (base.php) และส่งค่าให้กับ $pageTitle
<?php 
$pageTitle = "หน้าแรก";
include 'base.php';
?>

// สร้างตัวแปร $pageTitle ในหน้าฐาน (base.php)
<?php 
$pageTitle = "หน้าแรก";
?>

<!-- นำเนื้อหาของหน้าฐานมาแสดง -->
<?php include 'base.php'; ?>