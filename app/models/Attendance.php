<?php
class Attendance {
    private PDO $db;
    public function __construct(PDO $db) { $this->db = $db; }

    public function all(array $filters = []) {
        $sql = "SELECT attendances.*, employees.employee_number, employees.name, employees.department, employees.position
                FROM attendances JOIN employees ON employees.id = attendances.employee_id WHERE 1=1";
        $params = [];
        if (!empty($filters['from'])) { $sql .= " AND attendance_date >= ?"; $params[] = $filters['from']; }
        if (!empty($filters['to'])) { $sql .= " AND attendance_date <= ?"; $params[] = $filters['to']; }
        if (!empty($filters['employee_id'])) { $sql .= " AND employee_id = ?"; $params[] = (int)$filters['employee_id']; }
        if (!empty($filters['status'])) { $sql .= " AND status = ?"; $params[] = $filters['status']; }
        $sql .= " ORDER BY attendance_date DESC, attendances.id DESC";
        $stmt = $this->db->prepare($sql); $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function create(array $data) {
        $stmt = $this->db->prepare(
            "INSERT INTO attendances (employee_id, attendance_date, check_in, check_out, status, note)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            (int)($data['employee_id'] ?? 0),
            $data['attendance_date'] ?? date('Y-m-d'),
            ($data['check_in'] ?? '') !== '' ? $data['check_in'] : null,
            ($data['check_out'] ?? '') !== '' ? $data['check_out'] : null,
            $data['status'] ?? 'Hadir', trim($data['note'] ?? '')
        ]);
    }

    public function checkOut(int $id): bool {
        $stmt = $this->db->prepare(
            "UPDATE attendances SET check_out = CURTIME()
             WHERE id = ? AND status = 'Hadir' AND check_out IS NULL"
        );
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }

    public function employeeSummary() {
        $sql = "SELECT e.id, e.employee_number, e.name, e.department, e.position,
                COUNT(a.id) AS total_absensi,
                SUM(a.status = 'Hadir') AS hadir, SUM(a.status = 'Izin') AS izin,
                SUM(a.status = 'Sakit') AS sakit, SUM(a.status = 'Alpa') AS alpa
                FROM employees e LEFT JOIN attendances a ON a.employee_id = e.id
                GROUP BY e.id ORDER BY e.name";
        return $this->db->query($sql)->fetchAll();
    }
}
