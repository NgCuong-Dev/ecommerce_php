<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Web Bán Hàng</title>

    <!-- Sử dụng Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <header class="bg-success text-white text-center py-4">
        <h1>Trang Web Bán Hàng</h1>
    </header>

    <!-- Menu điều hướng sử dụng Bootstrap Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container flex start-end">
            <a class="navbar-brand" href="#">Trang Chủ</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/webbanhang/product/listproducts">Sản Phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/webbanhang/product/createProduct">Thêm Sản Phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Liên Hệ</a>
                    </li>


                    <li>
                        <?php
                        if (isset($_SESSION['user_id'])) {
                            echo "<span>Xin chao: " . $_SESSION['username'] . "</span>";
                            echo "<a href='/webbanhang/account/logout'>Logout</a>";
                        } else {
                            echo "<a href='/webbanhang/account/login'>login</a>";
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
        <span class="nav-item" style="padding-right: 80px">
            <a class="nav-link" href="#">
                <i style="width:30px;height:30px;font-size:30px;color:white" class="fa fa-shopping-cart"></i>
            </a>
        </span>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-9">