<?php
class User {
    private PDO $db;
    public function __construct(PDO $db) { $this->db = $db; }
    public function all(): array { return $this->db->query("SELECT id, username FROM users ORDER BY id DESC")->fetchAll(); }
    public function find(int $id): array|false { $s=$this->db->prepare("SELECT id, username FROM users WHERE id=?"); $s->execute([$id]); return $s->fetch(); }
    public function create(array $d): void {
        $s=$this->db->prepare("INSERT INTO users (username,password) VALUES (?,?)");
        $s->execute([trim($d['username'] ?? ''), password_hash($d['password'] ?? '', PASSWORD_DEFAULT)]);
    }
    public function update(int $id, array $d): void {
        if (trim($d['password'] ?? '') !== '') {
            $s=$this->db->prepare("UPDATE users SET username=?, password=? WHERE id=?");
            $s->execute([trim($d['username'] ?? ''), password_hash($d['password'], PASSWORD_DEFAULT), $id]);
        } else {
            $s=$this->db->prepare("UPDATE users SET username=? WHERE id=?");
            $s->execute([trim($d['username'] ?? ''), $id]);
        }
    }
    public function delete(int $id): void {
        if (isset($_SESSION['user_id']) && (int)$_SESSION['user_id'] === $id) { throw new RuntimeException('Akun yang sedang digunakan tidak dapat dihapus.'); }
        $s=$this->db->prepare("DELETE FROM users WHERE id=?"); $s->execute([$id]);
    }
}
