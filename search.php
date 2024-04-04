<?php

include('connect.php');

?>

<?php

$pageTitle = "New-Movie";
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
                        <li class="breadcrumb-item active"><a href="#" class="link-underline link-underline-opacity-0">ค้นหา <?php echo $search ?></a></li>
                    </ol>
                </nav>

                <div class="row">
                    <?php
                    if ($result_search->num_rows > 0) { //$result->num_rows ใช่เข้าถึงคุณสมบัติ num_rows ของ object $result
                        while ($movie = $result_search->fetch_assoc()) { //fetch_assoc() จะดึงข้อมูลแถวละหนึ่งแถวและคืนค่าเป็นอาร์เรย์ เก็บไว้ที่ $result_search
                    ?>
                            <div class="col-6 col-sm-6 col-md-3 col-lg-3 my-2">
                                <a href="<?php if ($movie['status_list'] == 'yes') { ?>list<?php } else { ?>play<?php } ?>.php?id=<?= $movie['id'] ?>" class="link-underline link-underline-opacity-0">
                                    <div class="card shadow-sm h-100">
                                        <img src=<?= $movie['img'] ?> class="rounded card-img-top h-100" alt="">
                                        <div class="card-body p-2">
                                            <p class="card-text text-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $movie['name'] ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    <?php
                    } else {
                    ?>
                        <div class="container">
                            <div class="alert alert-light d-flex d-flex justify-content-center h-100">
                                <div class="align-self-center fs-2">ไม่พบผลลัพธ์การค้นหาด้วยคำว่า " <?php echo $search ?> " </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    include('footer.php');
    ?>
</body>