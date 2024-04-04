<?php
include('connect.php');

$id = @$_GET['id']; //get id จากหน้าเพจ
// ถ้าไม่มี id ใน url ให้หยุดทำงาน
if (!$id) {
    echo 'No id';
    exit; // หยุดทำงาน
}

$list = @$_GET['list']; //get id จากหน้าเพจ

if (!$list) {
    //ถ้าไม่มี list ให้เชื่อมต่อฐานข้อมูล data_movie
    $query = mysqli_query($connect, "SELECT * FROM data_movie WHERE id = $id");
    $result = mysqli_fetch_array($query);
} else {
    $query = mysqli_query($connect, "SELECT * FROM data_movie WHERE id = $id");
    $result = mysqli_fetch_array($query);

    //ถ้ามี list ให้เชื่อมต่อฐานข้อมูล data_list
    $query_list = mysqli_query($connect, "SELECT * FROM data_list WHERE main_id = $id and part = $list");
    $result_list = mysqli_fetch_array($query_list);

    $num_list = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM data_list WHERE main_id = $id"));
}

?>

<?php
$pageTitle = $result['name'];
include('base.php');
?>

<body style="background-image: url('<?= $result['img'] ?>'); background-size: cover;">
    <?php
    include('header.php');
    ?>

    <div class="container mt-4">
        <?php
        if (!$list) {
        ?>
            <!-- Movie -->
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

            <div class="row mb-5" style="height: 50vh;">
                <div class="col-md-12 my-2">
                    <div class="tab-content w-100 h-100" id="nav-tabContent">
                        <div class="tab-pane fade show active w-100 h-100" id="play1">
                            <div class="text-center rounded-3 p-1 mb-3" style="background-color:#E1E1E1">ตัวเล่นหลัก</div>
                            <div class="card shadow-sm w-100 h-100">
                                <iframe class="w-100 h-100" src="https://www.youtube.com/embed/<?= $result['vdo_main'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="tab-pane fade w-100 h-100" id="play2">
                            <div class="text-center rounded-3 p-1 mb-3" style="background-color:#E1E1E1">ตัวเล่นสำรอง 1</div>
                            <div class="card shadow-sm w-100 h-100">
                                <iframe class="w-100 h-100" src="https://www.youtube.com/embed/<?= $result['vdo_main_2'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="tab-pane fade w-100 h-100" id="play3">
                            <div class="text-center rounded-3 p-1 mb-3" style="background-color:#E1E1E1">ตัวเล่นสำรอง 2</div>
                            <div class="card shadow-sm w-100 h-100">
                                <iframe class="w-100 h-100" src="https://www.youtube.com/embed/<?= $result['vdo_main_3'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="d-flex justify-content-center my-3">
                    <div class="col-sm-4 col-md-6">
                        <div class="list-group list-group-horizontal text-center">
                            <a class="list-group-item list-group-item-action active d-flex justify-content-center" data-bs-toggle="list" href="#play1">
                                <div class="align-self-center">ตัวเล่นหลัก</div>
                            </a>
                            <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#play2">
                                <div class="align-self-center">ตัวเล่นสำรอง 1</div>
                            </a>
                            <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#play3">
                                <div class="align-self-center">ตัวเล่นสำรอง 2</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Movie End -->
        <?php
        } else {
        ?>
            <!-- List -->
            <nav>
                <ol class="breadcrumb px-2 py-2 mt-5 mb-3 rounded-3" style="background-color:#E1E1E1">
                    <li class="breadcrumb-item"><a href="./" class="link-underline link-underline-opacity-0">หน้าหลัก</a></li>
                    <li class="breadcrumb-item"><a href="list.php?id=<?= $id ?>" class="link-underline link-underline-opacity-0"><?= $result_list['name'] ?></a></li>
                    <li class="breadcrumb-item active"> ตอนที่ <?= $result_list['part'] ?></li>
                </ol>
            </nav>

            <div class="row mb-2">
                <div class="col-3 col-sm-3 col-md-3">
                    <a class="btn w-100 h-100 d-flex justify-content-center <?php if ($list <= 1) {
                                                                                echo "disabled";
                                                                            } ?>" style="background-color:#E1E1E1;" href="play.php?id=<?= $id ?>&list=<?= $list - 1 ?>">
                        <div class="align-self-center">ตอนก่อนหน้า</div>
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-6">
                    <div class="d-flex justify-content-center rounded-2 w-100 h-100" style="background-color:#E1E1E1">
                        <div class="align-self-center">ตอนที่ <?= $result_list['part'] ?></div>
                    </div>
                </div>
                <div class="col-3 col-sm-3 col-md-3">
                    <a class="btn w-100 h-100 d-flex justify-content-center <?php if ($list >= $num_list) {
                                                                                echo "disabled";
                                                                            } ?>" style="background-color:#E1E1E1;" href="play.php?id=<?= $id ?>&list=<?= $list + 1 ?>">
                        <div class="align-self-center">ตอนถัดไป</div>
                    </a>
                </div>
            </div>

            <div class="row mb-5" style="height: 50vh;">
                <div class="col-md-12 my-2">
                    <div class="tab-content w-100 h-100" id="nav-tabContent">
                        <div class="tab-pane fade show active w-100 h-100" id="play1">
                            <div class="text-center rounded-3 p-1 mb-3" style="background-color:#E1E1E1">ตัวเล่นหลัก</div>
                            <div class="card shadow-sm w-100 h-100">
                                <iframe class="w-100 h-100" src="https://www.youtube.com/embed/<?= $result_list['vdo'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="tab-pane fade w-100 h-100" id="play2">
                            <div class="text-center rounded-3 p-1 mb-3" style="background-color:#E1E1E1">ตัวเล่นสำรอง 1</div>
                            <div class="card shadow-sm w-100 h-100">
                                <iframe class="w-100 h-100" src="https://www.youtube.com/embed/<?= $result_list['vdo_2'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="tab-pane fade w-100 h-100" id="play3">
                            <div class="text-center rounded-3 p-1 mb-3" style="background-color:#E1E1E1">ตัวเล่นสำรอง 2</div>
                            <div class="card shadow-sm w-100 h-100">
                                <iframe class="w-100 h-100" src="https://www.youtube.com/embed/<?= $result_list['vdo_3'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="d-flex justify-content-center my-3">
                    <div class="col-sm-4 col-md-6">
                        <div class="list-group list-group-horizontal text-center">
                            <a class="list-group-item list-group-item-action active d-flex justify-content-center" data-bs-toggle="list" href="#play1">
                                <div class="align-self-center">ตัวเล่นหลัก</div>
                            </a>
                            <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#play2">
                                <div class="align-self-center">ตัวเล่นสำรอง 1</div>
                            </a>
                            <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#play3">
                                <div class="align-self-center">ตัวเล่นสำรอง 2</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- List End -->
    </div>
<?php
        }
?>

</div>

<?php
include('footer.php');
?>

</body>

</html>