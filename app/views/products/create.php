<?php
include_once("app/views/header.php");
?>
<div class="row">
    <form id="form-createproduct" method="post" action="/webbanhang/product/saveProduct">
        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name">
            <p id="name-error" style="color: red;"></p>
            <?php if (isset($errors['name'])) : ?>
                <p id="name-error" style="color: red;"><?php echo $errors['name']; ?></p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <input type="text" class="form-control" id="description" name="description">
        </div>
        <div class="form-group">
            <label for="price">Giá</label>
            <input type="text" class="form-control" id="price" name="price">
        </div>
        <div class="pt-3">
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </div>
    </form>
</div>
<?php
include_once("app/views/footer.php");
?>