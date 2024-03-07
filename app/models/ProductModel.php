<?php
class ProductModel
{
    private $conn;

    private $table_name = "product";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getProducts()
    {
        // Truy vấn lấy tất cả sản phẩm
        $query = "SELECT id, name, description, price FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    // Trong ProductModel
    // Trong ProductModel
    public function addToCart($productId, $quantity)
    {
        // Lấy số lượng hiện tại trong giỏ hàng
        $currentQuantity = SessionHelper::getCartQuantity($productId);

        // Tăng số lượng lên thêm số lượng mới
        $newQuantity = $currentQuantity + $quantity;

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        if ($currentQuantity > 0) {
            // Nếu có, cập nhật số lượng
            $query = "UPDATE cart SET quantity = :quantity WHERE product_id = :product_id";
        } else {
            // Nếu chưa có, thêm sản phẩm mới vào giỏ hàng
            $query = "INSERT INTO cart (product_id, quantity) VALUES (:product_id, :quantity)";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':quantity', $newQuantity);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
    }





    public function getProductById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " where id = $id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function createProduct($name, $description, $price)
    {
        // Kiểm tra ràng buộc đầu vào
        $errors = [];
        if (empty($name)) {
            $errors['name'] = 'Tên sản phẩm không được để trống';
        }
        if (empty($description)) {
            $errors['description'] = 'Mô tả không được để trống';
        }
        if (!is_numeric($price) || $price < 0) {
            $errors['price'] = 'Giá sản phẩm không hợp lệ';
        }

        if (count($errors) > 0) {
            return $errors;
        }

        // Truy vấn tạo sản phẩm mới

        $query = "INSERT INTO " . $this->table_name . " (name, description, price) VALUES (:name, :description, :price)";
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $price = htmlspecialchars(strip_tags($price));

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function updateProduct($id, $name, $description, $price)
    {
        $query = "UPDATE " . $this->table_name . " SET name=:name, description=:description, price=:price WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $price = htmlspecialchars(strip_tags($price));

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // public function updateProduct($id, $name, $description, $price)
    // {
    //     // Truy vấn cập nhật sản phẩm
    // }

    public function deleteProduct($id)
    {
        // Truy vấn xóa sản phẩm
    }
}
