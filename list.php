<?php
include('connect.php');

$id = @$_GET['id']; //get id จากหน้าเพจ
// ถ้าไม่มี id ใน url ให้หยุดทำงาน
if (!$id) {
    echo 'No id';
    exit; // หยุดทำงาน
}

$query = mysqli_query($connect, "SELECT * FROM data_movie WHERE id = $id");
$result = mysqli_fetch_array($query);

$query_list = mysqli_query($connect, "SELECT * FROM data_list WHERE main_id = $id");
?>

<?php
$pageTitle = $result['name'];
include('base.php');
?>

<body style="background-image: url('<?= $result['img'] ?>'); background-size: 100%;">
    <?php
    include('header.php');
    ?>

    <div class="container mt-4">
        <nav>
            <ol class="breadcrumb px-2 py-2 mt-5 mb-3 rounded-3" style="background-color:#E1E1E1">
                <li class="breadcrumb-item"><a href="./" class="link-underline link-underline-opacity-0">หน้าหลัก</a></li>
                <?php
                if (strpos($_SERVER['HTTP_REFERER'], 'category') !== false) {
                ?>
                    <li class="breadcrumb-item"><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="link-underline link-underline-opacity-0">หมวดหมู่ <?= $result['category'] ?></a></li>
                <?php } ?>
                <li class="breadcrumb-item active"><a href="#" class="link-underline link-underline-opacity-0"><?= $result['name'] ?></a></li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-3 my-2">
                <div class="card shadow-sm">
                    <img src="<?= $result['img'] ?>" width="50%" height="auto" class="rounded card-img-top" alt="">
                </div>
            </div>
            <div class="col-md-9 my-2">
                <div class="card shadow-sm w-100 h-100">
                    <iframe class="w-100 h-100" src="https://www.youtube.com/embed/<?= $result['vdo_ex'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <div class="text-center rounded-3 p-1 my-2" style="background-color:#E1E1E1">รายการ</div>
        <div class="card shadow-sm w-100 h-100">
            <div class="list-group">
                <?php
                while ($result_list = mysqli_fetch_array($query_list)) {
                    echo '<a type="button" class="list-group-item list-group-item-action list-group-item-dark" href="play.php?id=' . $id . '&list=' . $result_list['part'] . '">' . $result_list['name'] . ' ตอนที่ ' . $result_list['part'] . ' </a>';
                }
                ?>
            </div>
        </div>
    </div>

    <?php
    include('footer.php');
    ?>

</body>

</html>