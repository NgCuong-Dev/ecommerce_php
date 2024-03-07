<?php
include_once("app/views/header.php");
?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Des</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['description']; ?></td>
                <td><?= $row['price']; ?></td>
                <td><a class="btn btn-primary mb-2 bg-danger" style="width:52%" href="/webbanhang/product/editProduct/<?= $row['id']; ?>">EDIT</a>
                    <form action="/webbanhang/product/addToCart" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" class="btn btn-primary">Thêm vào Giỏ Hàng</button>
                    </form>
                </td>

            </tr>
        <?php endwhile; ?>

    </tbody>
</table>
<?php
include_once("app/views/footer.php");
?>