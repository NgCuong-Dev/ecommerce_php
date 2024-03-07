<?php
class DefaultController
{
    private $productModel;
    private $db;
    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }
    public function index()
    {
        $products = $this->productModel->getProducts();
        include_once 'app/views/index.php';
    }
}
