<nav class="d-flex justify-content-center mt-3">
    <?php if ($num_page > 1) { ?>
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
                    <a class="page-link" href="?category=<?= $category ?>&Page=<?= $page - 1 ?>">ก่อนหน้า</a>
                </li>
            <?php
            }
            ?>
            <!--------------------------------------------------->
            <?php
            if ($page > 5) {
            ?>
                <li class="page-item">
                    <a class="page-link" href="?category=<?= $category ?>&Page=1">1</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link">...</a>
                </li>
            <?php
            }
            ?>
            <!--------------------------------------------------->
            <?php
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
            } else {
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
                        <a class="page-link" href="?category=<?= $category ?>&Page=<?= $i ?>"><?= $i ?></a>
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
                    <a class="page-link" href="?category=<?= $category ?>&Page=<?= $num_page ?>"><?= $num_page ?></a>
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
                    <a class="page-link" href="?category=<?= $category ?>&Page=<?= $page + 1 ?>">ถัดไป</a>
                </li>
            <?php
            }
            ?>
        </ul>
    <?php } ?>
</nav>