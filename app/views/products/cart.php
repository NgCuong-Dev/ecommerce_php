<?php
// Giả sử đây là trang /webbanhang/cart

include_once("app/views/header.php");

// Giả sử bạn có một hàm để lấy thông tin giỏ hàng
$cartItems = SessionHelper::getCartItems(); // Cần triển khai hàm này

// Biến lưu trữ thông tin sản phẩm đã thêm vào
$product = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'] ?? '';
    $quantity = $_POST['quantity'] ?? 1; // Số lượng mặc định là 1 nếu không được chỉ định

    if (!is_numeric($productId) || $productId < 1) {
        // ID sản phẩm không hợp lệ
        echo htmlspecialchars('ID sản phẩm không hợp lệ');
        return;
    }

    $product = $this->productModel->getProductById($productId);
    if (!$product) {
        // Sản phẩm không tồn tại
        echo htmlspecialchars('Sản phẩm không tồn tại');
        return;
    }

    if ($quantity > $product->quantity) {
        // Số lượng sản phẩm vượt quá số lượng tồn kho
        echo htmlspecialchars('Số lượng sản phẩm vượt quá số lượng tồn kho');
        return;
    }

    // Thêm sản phẩm vào giỏ hàng
    $this->productModel->addToCart($productId, $quantity);

    // Cập nhật giá trị của biến product
    $product = $product;
}

if ($product) {
?>
    <div class="alert alert-success">
        Sản phẩm <b><?= $product->name; ?></b> với số lượng <b><?= $product->quantity; ?></b> đã được thêm vào giỏ hàng của bạn.
    </div>

    <div class="product-info">
        <img src="<?= $product->image; ?>" alt="Ảnh sản phẩm">
        <h3><?= $product->name; ?></h3>
        <p><?= $product->description; ?></p>
        <p>Giá: <?= $product->price; ?></p>
    </div>
<?php } ?>

// Hiển thị thông tin giỏ hàng
if ($cartItems) :
?>
<table class="table">
</table>

<?php
include_once("app/views/footer.php");
?>