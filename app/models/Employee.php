<?php
class Employee {
    private PDO $db;
    public function __construct(PDO $db) { $this->db = $db; }

    public function all() {
        return $this->db->query("SELECT * FROM employees ORDER BY id DESC")->fetchAll();
    }

    public function create(array $data) {
        $stmt = $this->db->prepare(
            "INSERT INTO employees (employee_number, name, department, position)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([
            trim($data['employee_number'] ?? ''),
            trim($data['name'] ?? ''),
            trim($data['department'] ?? ''),
            trim($data['position'] ?? '')
        ]);
    }
}
