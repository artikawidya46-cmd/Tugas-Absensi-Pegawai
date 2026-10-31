<?php
require_once __DIR__ . '/../models/Product.php';
class ProductController {
    private Product $model;
    public function __construct(PDO $db) { $this->model = new Product($db); }
    private function render(string $page,string $title,array $data=[]): void { extract($data); ob_start(); require __DIR__.'/../../views/pages/products/'.$page.'.php'; $content=ob_get_clean(); require __DIR__.'/../../views/layouts/main.php'; }
    public function index(): void { $this->render('index','Data Produk',['products'=>$this->model->all()]); }
    public function create(): void { $this->render('form','Tambah Produk',['product'=>['id'=>'','name'=>'','description'=>'','price'=>'','stock'=>''],'editing'=>false]); }
    public function store(): void { if($_SERVER['REQUEST_METHOD']!=='POST'){header('Location: /products');exit;} if(trim($_POST['name']??'')==='' || !is_numeric($_POST['price']??null) || !is_numeric($_POST['stock']??null)){$_SESSION['flash']='Nama, harga, dan stok harus diisi dengan benar.';header('Location: /products/create');exit;} $this->model->create($_POST);$_SESSION['flash']='Produk berhasil ditambahkan.';header('Location: /products');exit; }
    public function edit(): void { $v=$this->model->find((int)($_GET['id']??0));if(!$v){http_response_code(404);exit('Produk tidak ditemukan');}$this->render('form','Edit Produk',['product'=>$v,'editing'=>true]); }
    public function update(): void { $id=(int)($_POST['id']??0);if(!$id || trim($_POST['name']??'')==='' || !is_numeric($_POST['price']??null) || !is_numeric($_POST['stock']??null)){$_SESSION['flash']='Data produk tidak valid.';header('Location: /products');exit;}$this->model->update($id,$_POST);$_SESSION['flash']='Produk berhasil diperbarui.';header('Location: /products');exit; }
    public function delete(): void { if($_SERVER['REQUEST_METHOD']==='POST'){$this->model->delete((int)($_POST['id']??0));$_SESSION['flash']='Produk berhasil dihapus.';}header('Location: /products');exit; }
}
