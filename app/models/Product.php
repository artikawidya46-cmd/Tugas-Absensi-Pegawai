<?php
class Product {
    private PDO $db;
    public function __construct(PDO $db) { $this->db = $db; }
    public function all(): array { return $this->db->query("SELECT * FROM products ORDER BY id DESC")->fetchAll(); }
    public function find(int $id): array|false { $s=$this->db->prepare("SELECT * FROM products WHERE id=?"); $s->execute([$id]); return $s->fetch(); }
    public function create(array $d): void {
        $s=$this->db->prepare("INSERT INTO products (name,description,price,stock) VALUES (?,?,?,?)");
        $s->execute([trim($d['name'] ?? ''), trim($d['description'] ?? ''), (float)($d['price'] ?? 0), (int)($d['stock'] ?? 0)]);
    }
    public function update(int $id, array $d): void {
        $s=$this->db->prepare("UPDATE products SET name=?, description=?, price=?, stock=? WHERE id=?");
        $s->execute([trim($d['name'] ?? ''), trim($d['description'] ?? ''), (float)($d['price'] ?? 0), (int)($d['stock'] ?? 0), $id]);
    }
    public function delete(int $id): void { $s=$this->db->prepare("DELETE FROM products WHERE id=?"); $s->execute([$id]); }
}
