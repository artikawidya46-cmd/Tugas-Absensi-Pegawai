<?php
class HomeController {
    private PDO $db;
    public function __construct(PDO $db) { $this->db = $db; }

    public function index() {
        $title = 'Dashboard Absensi';
        $totalEmployees = (int)$this->db->query("SELECT COUNT(*) FROM employees")->fetchColumn();
        $todayAttendance = (int)$this->db->query("SELECT COUNT(*) FROM attendances WHERE attendance_date = CURDATE()")->fetchColumn();
        ob_start();
        require __DIR__ . '/../../views/pages/home.php';
        $content = ob_get_clean();
        require __DIR__ . '/../../views/layouts/main.php';
    }
}
