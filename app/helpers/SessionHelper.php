<?php
session_start();

class SessionHelper
{
    public static function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    public static function isAdmin()
    {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }
    public static function getCartQuantity()
    {
        return
            $currentQuantity = 0;
    }
    public function getCartItems()
    {
        // Giả sử giỏ hàng được lưu trong Session
        // Bạn có thể thay thế bằng cơ chế lưu trữ khác nếu cần thiết
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        // Trả về thông tin sản phẩm trong giỏ hàng
        return $cart;
    }
}
