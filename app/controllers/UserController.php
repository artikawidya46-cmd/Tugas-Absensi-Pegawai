<?php
require_once __DIR__ . '/../models/User.php';
class UserController {
    private User $model;
    public function __construct(PDO $db) { $this->model = new User($db); }
    private function render(string $page, string $title, array $data=[]): void {
        extract($data); ob_start(); require __DIR__ . '/../../views/pages/users/' . $page . '.php';
        $content=ob_get_clean(); require __DIR__ . '/../../views/layouts/main.php';
    }
    public function index(): void { $this->render('index','Data User',['users'=>$this->model->all()]); }
    public function create(): void { $this->render('form','Tambah User',['user'=>['id'=>'','username'=>''],'editing'=>false]); }
    public function store(): void {
        if ($_SERVER['REQUEST_METHOD']!=='POST') { header('Location: /users'); exit; }
        $username=trim($_POST['username']??''); $password=$_POST['password']??'';
        if ($username==='' || $password==='') { $_SESSION['flash']='Username dan password wajib diisi.'; header('Location: /users/create'); exit; }
        try { $this->model->create($_POST); $_SESSION['flash']='User berhasil ditambahkan.'; }
        catch (PDOException $e) { $_SESSION['flash']='Gagal menambah user. Username mungkin sudah digunakan.'; }
        header('Location: /users'); exit;
    }
    public function edit(): void { $u=$this->model->find((int)($_GET['id']??0)); if(!$u){http_response_code(404);exit('User tidak ditemukan');} $this->render('form','Edit User',['user'=>$u,'editing'=>true]); }
    public function update(): void {
        $id=(int)($_POST['id']??0); $username=trim($_POST['username']??'');
        if(!$id || $username===''){$_SESSION['flash']='Data user tidak valid.';header('Location: /users');exit;}
        try { $this->model->update($id,$_POST); if(isset($_SESSION['user_id']) && (int)$_SESSION['user_id']===$id) $_SESSION['username']=$username; $_SESSION['flash']='User berhasil diperbarui.'; }
        catch(PDOException $e){$_SESSION['flash']='Gagal memperbarui user. Username mungkin sudah dipakai.';}
        header('Location: /users'); exit;
    }
    public function delete(): void { if($_SERVER['REQUEST_METHOD']==='POST'){try{$this->model->delete((int)($_POST['id']??0));$_SESSION['flash']='User berhasil dihapus.';}catch(Throwable $e){$_SESSION['flash']=$e->getMessage();}} header('Location: /users'); exit; }
}
