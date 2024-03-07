<?php
// Require SessionHelper and other necessary files
require_once('app/helpers/SessionHelper.php');

class ProductController
{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    public function listProducts()
    {
        if (!SessionHelper::isAdmin()) {
            header('Location: /webbanhang/account/login');
            exit;
        }
        $products = $this->productModel->getProducts();
        include_once 'app/views/products/list.php';
    }

    public function createProduct()
    {
        // if (!SessionHelper::isAdmin()) {
        //     header('Location: login.php');
        //     exit;
        // }
        // Xử lý tạo sản phẩm
        include_once 'app/views/products/create.php';
    }

    public function addToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? '';
            $quantity = $_POST['quantity'] ?? 1;

            if (!is_numeric($productId) || $productId < 1) {
                echo 'ID sản phẩm không hợp lệ';
                return;
            }

            $product = $this->productModel->getProductById($productId);
            if (!$product) {
                echo 'Sản phẩm không tồn tại';
                return;
            }

            if ($quantity > $product->quantity) {
                echo 'Số lượng sản phẩm vượt quá số lượng tồn kho';
                return;
            }

            // Thêm sản phẩm vào giỏ hàng
            $this->productModel->addToCart($productId, $quantity);

            // Chuyển hướng về trang danh sách sản phẩm hoặc giỏ hàng
            header('Location: /webbanhang/products/cart.php');
        }
    }
    public function saveProduct()
    {
        // Kiểm tra xem liệu form đã được submit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';

            $result = $this->productModel->createProduct($name, $description, $price);

            if (is_array($result)) {
                // Có lỗi, hiển thị lại form với thông báo lỗi
                $errors = $result;
                include 'app/views/products/create.php'; // Đường dẫn đến file form sản phẩm
            } else {
                // Không có lỗi, chuyển hướng ve trang chu hoac trang danh sach
                header('Location: /webbanhang/Product/listProducts');
            }
        }
    }

    public function editProduct($id)
    {

        $product = $this->productModel->getProductById($id);

        if ($product) {
            include_once 'app/views/products/edit.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    public function updateProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $id = $_POST['id'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $edit = $this->productModel->updateProduct($id, $name, $description, $price);

            if ($edit) {
                header('Location: /webbanhang/Product/listProducts');
            } else {
                //thuc hien tuong tu nhu ham luu
                echo "Đã xảy ra lỗi khi lưu sản phẩm.";
            }
        }
    }


    // public function updateProduct($id)
    // {
    //     if (!SessionHelper::isAdmin()) {
    //         header('Location: login.php');
    //         exit;
    //     }
    //     // Xử lý cập nhật sản phẩm
    // }

    public function deleteProduct($id)
    {
        if (!SessionHelper::isAdmin()) {
            header('Location: login.php');
            exit;
        }
        // Xử lý xóa sản phẩm
    }
}
