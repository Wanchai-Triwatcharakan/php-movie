<?php
include('connect.php');

$category = $_GET['category'];

$num_rows = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_movie WHERE category = '$category'")); //เช็คแถว //ใช้ดึงจำนวนแถวที่ได้จากการดำเนินการคิวรี (query) ที่ส่งไปยังฐานข้อมูล MySQL

$limit_page = 16; // 1 หน้ามีกี่เรื่อง

// ตรวจสอบหน้าแรกของเพจว่าได้กำหนดค่าหรือยัง ถ้ายังให้กำหนดค่าเป็น หน้า 1
// isset ใช้ตรวจสอบว่าตัวแปรหรืออินเด็กซ์ของอาร์เรย์นั้น ๆ ถูกกำหนดค่าหรือยัง
// if(isset($_GET['Page'])){
//     $page = $_GET['Page']; // เลขหน้า
// }else{
//     $page = 1;
// }
// หรือ
// @ เพื่อป้องกันการแสดง error ในกรณีที่ $_GET['Page'] ไม่ได้ถูกกำหนด (undefined) หรือไม่มีอยู่
//  (? :) เพื่อกำหนดค่าให้กับตัวแปร $page ด้วยการตรวจสอบว่า $_GET['Page'] มีค่าหรือไม่ ถ้ามีค่าจะกำหนดค่าเป็น $_GET['Page'] นั้นเอง แต่ถ้าไม่มีค่า (หรือเป็น null) จะกำหนดค่าให้เป็น 1
$page = @$_GET['Page'] ? $_GET['Page'] : 1;

$next_page_url = "http://localhost/movie/category.php?category=" . urlencode($category) . "&Page=" . ($page + 1);

$num_page = $num_rows / $limit_page; // หาจำนวนหน้าทั้งหมดของเว็บ เรื่องทั้งหมดที่มี/เรื่องต่อหน้า
if (!($num_page == (int)$num_page)) // ตรวจสอบ $num_page เป็นจำนวนเต็มหรือไม่ 
    $num_page = (int)$num_page + 1; // ปัด $num_page ขึ้น

// กันไม่ให้หน้าปัจจุบัน เกินหน้าสูงสุด
if ($page > $num_page) {
    $page = $num_page;
}
$limit_start =  max(0, ($page * $limit_page) - $limit_page); // เริ่มต้นที่หน้าไหน หน้าแรกนับ 0-7 หน้า 2 นับ 8-15 , max(0, ) จะเลือกค่าที่มากที่สุดระหว่าง 0 และ ($page * $limit_page) - $limit_page จึงทำให้ $limit_start ไม่เป็นค่าติดลบ
?>

<?php
$category = $_GET['category']; // เครื่องหมาย ? ใน url ใช้คู่กับ $_GET เพื่อรับค่าพารามิเตอร์ที่ต้องการ ('category') หลังเครื่องหมาย ?
$pageTitle = "หมวดหมู่ " . $category;
include('base.php');
?>

<body>
    <?php
    include('header.php');
    ?>

    <div class="overlay">
        <div class="album py-2 mt-5">
            <div class="container">
                <nav>
                    <ol class="breadcrumb px-2 py-2 mt-3 mb-3 rounded-3" style="background-color:#E1E1E1">
                        <li class="breadcrumb-item active"><a href="./" class="link-underline link-underline-opacity-0">หน้าหลัก</a></li>
                        <li class="breadcrumb-item active"><a href="#" class="link-underline link-underline-opacity-0">หมวดหมู่ <?php echo "$category" ?></a></li>
                    </ol>
                </nav>

                <div class="row">
                    <?php
                    $query = mysqli_query($connect, "SELECT * FROM data_movie WHERE category = '$category' ORDER BY id DESC LIMIT $limit_start,$limit_page"); //ส่งคำสั่ง SQL ไปที่ MySQL database ที่ชื่อ data_movie
                    if (mysqli_num_rows($query) > 0) {
                        while ($result = mysqli_fetch_array($query)) { //ใช้ดึงข้อมูลจากผลลัพธ์ของคำสั่ง SQL ที่ถูกส่งไปที่ MySQL database ออกมาในรูปแบบของ array
                    ?>
                            <div class="col-6 col-sm-6 col-md-3 col-lg-3 my-2">
                                <a href="<?php if ($result['status_list'] == 'yes') { ?>list<?php } else { ?>play<?php } ?>.php?id=<?= $result['id'] ?>" class="link-underline link-underline-opacity-0">
                                    <div class="card shadow-sm h-100">
                                        <img src=<?= $result['img'] ?> class="rounded card-img-top h-100" alt="">
                                        <div class="card-body p-2">
                                            <p class="card-text text-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $result['name'] ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="container">
                            <div class="alert alert-light d-flex d-flex justify-content-center h-100">
                                <div class="align-self-center fs-2 text-center ">ยังไม่มีรายการที่อยู่ในหมวดหมู่ <br> " <?php echo "$category" ?> "</div>
                            </div>
                        </div> 
                    <?php } ?>
                </div>

                <?php
                include('paginator_category.php');
                ?>

            </div>
        </div>
    </div>

    <?php
    include('footer.php');
    ?>

    <!-- // show_movies.php

 // ตรวจสอบว่ามีการรับค่า category ผ่าน URL หรือไม่
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    
    // สร้างคำสั่ง SQL เพื่อดึงข้อมูลตาม category
    $query = "SELECT * FROM data_movie WHERE category = '$category'";
    $result = mysqli_query($connect, $query);

    if (!$result) {
        die("เกิดข้อผิดพลาดในการดึงข้อมูล: " . mysqli_error($connect));
    }

    echo "<h2>รายการหนังในหมวดหมู่ $category</h2>";
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . $row['movie_title'] . "</li>";
    }
    echo "</ul>";

    mysqli_close($connect);
} else {
    echo "ไม่พบหมวดหมู่ที่ระบุ";
} -->