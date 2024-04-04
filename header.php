<?php

$search = @$_GET['search'] ? $_GET['search']:'';
$sql = "SELECT * FROM data_movie WHERE name LIKE '%$search%' ORDER BY id DESC ";
$result_search = $connect->query($sql);

?>

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
                            <li><a class="dropdown-item" href="category.php?category=หนังไทย">หนังไทย</a></li>
                            <li><a class="dropdown-item" href="category.php?category=หนังฝรั่ง">หนังฝรั่ง</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            ซีรีย์
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="category.php?category=ซีรีย์เกาหลี">ซีรีย์เกาหลี</a></li>
                            <li><a class="dropdown-item" href="category.php?category=ซีรีย์ฝรั่ง">ซีรีย์ฝรั่ง</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="category.php?category=การ์ตูน">การ์ตูน</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" method="GET" action="search.php">
                    <input class="form-control me-2" type="text" name="search" placeholder="ค้นหา">
                    <button class="btn btn-outline-success" type="submit">ค้นหา</button>
                </form>
            </div>
        </div>
    </nav>
</header>