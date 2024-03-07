<?php
include_once("app/views/header.php");
?>
<div class="row">
    <?php while ($row = $product->fetch(PDO::FETCH_ASSOC)) : ?>
        <form action="/WebBanHang/product/updateProduct" method="post">
            <h1>Sửa sản phẩm</h1>
            <input type="text" hidden class="form-control" placeholder="Tên" name="id" id="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="name">Tên</label>
                <input type="text" class="form-control" placeholder="Tên" name="name" value=" <?php echo  $row['name']; ?>" id="name">
            </div>
            <div class="form-group">
                <label for="description">Mô tả</label>
                <input type="text" class="form-control" placeholder="description" name="description" id="description" value=" <?php echo  $row['description']; ?>">
            </div>
            <div class="form-group">
                <label for="mspricesv">Giá</label>
                <input type="text" class="form-control" min="1" placeholder="price" name="price" id="price" value=" <?php echo  $row['price']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Sửa</button>

        </form>
    <?php endwhile; ?>
</div>
<?php
include_once("app/views/footer.php");
?>