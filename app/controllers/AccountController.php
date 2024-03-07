<?php
class AccountController
{
    private $accountModel;
    private $db;
    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
    }
    public function login()
    {
        include_once 'app/views/login.php';
    }
    public function checkLogin()
    {
        // Kiểm tra xem liệu form đã được submit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $account = $this->accountModel->getAccountByUserName($username);
            if ($account) {
                $pwd_hashed = $account->password;
                //check mat khau
                if (password_verify($password, $pwd_hashed)) {

                    session_start();

                    $_SESSION['user_id'] = $account->id;
                    $_SESSION['user_role'] = $account->role;
                    $_SESSION['username'] = $account->username;

                    header('Location: /webbanhang/product/listproducts');
                    exit;
                } else {
                    echo "Password incorrect.";
                }
            } else {
                echo "Bao loi khong tim thay tai khoan";
            }
        }
    }
}
