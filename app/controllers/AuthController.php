<?php
class AuthController {
    private PDO $db;
    public function __construct(PDO $db) { $this->db = $db; }

    public function login() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([trim($_POST['username'] ?? '')]);
            $user = $stmt->fetch();
            if ($user && password_verify($_POST['password'] ?? '', $user['password'])) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: /');
                exit;
            }
            $error = 'Username atau password salah.';
        }
        require __DIR__ . '/../../views/pages/auth/login.php';
    }

    public function logout() {
        $_SESSION = [];
        session_destroy();
        header('Location: /login');
        exit;
    }
}
