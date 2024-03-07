<?php
include_once("header.php");
?>

<!-- Danh sách sản phẩm -->

<!-- Hiển thị sản phẩm bằng dạng dòng sản phẩm sử dụng Bootstrap Row và Col -->
<div class="row row-cols-1 row-cols-md-3 g-4">
  <!-- Sản phẩm 1 -->

  <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)) : ?>
    <div class="col">
      <div class="card">
        <img src="https://picsum.photos/id/684/600/400" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><?php echo $row['name'] ?></h5>
          <p class="card-text"><?= $row['description'] ?></p>
          <p class="card-text"><?= $row['price'] ?></p>
          <a href="#" class="btn btn-primary">Mua Ngay</a>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
</div>



<?php
include_once("footer.php");
?>