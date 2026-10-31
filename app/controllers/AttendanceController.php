<?php
require_once __DIR__ . '/../models/Attendance.php';
require_once __DIR__ . '/../models/Employee.php';

class AttendanceController {
    private Attendance $attendance; private Employee $employee;
    public function __construct(PDO $db) { $this->attendance = new Attendance($db); $this->employee = new Employee($db); }
    public function index() {
        $title = 'Data Absensi'; $attendances = $this->attendance->all();
        ob_start(); require __DIR__ . '/../../views/pages/attendance/index.php'; $content = ob_get_clean();
        require __DIR__ . '/../../views/layouts/main.php';
    }
    public function create() {
        $title = 'Tambah Absensi'; $employees = $this->employee->all();
        ob_start(); require __DIR__ . '/../../views/pages/attendance/create.php'; $content = ob_get_clean();
        require __DIR__ . '/../../views/layouts/main.php';
    }
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: /attendance'); exit; }
        $this->attendance->create($_POST); header('Location: /attendance'); exit;
    }
    public function checkOut() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /attendance'); exit;
        }
        $id = filter_input(INPUT_POST, 'attendance_id', FILTER_VALIDATE_INT);
        if ($id) {
            $this->attendance->checkOut($id);
        }
        header('Location: /attendance'); exit;
    }

    public function report() {
        $title = 'Laporan Kehadiran';
        $filters = ['from' => $_GET['from'] ?? '', 'to' => $_GET['to'] ?? '', 'employee_id' => $_GET['employee_id'] ?? '', 'status' => $_GET['status'] ?? ''];
        $employees = $this->employee->all(); $attendances = $this->attendance->all($filters);
        ob_start(); require __DIR__ . '/../../views/pages/attendance/report.php'; $content = ob_get_clean();
        require __DIR__ . '/../../views/layouts/main.php';
    }
    public function summary() {
        $title = 'Rekap Pegawai'; $summaries = $this->attendance->employeeSummary();
        ob_start(); require __DIR__ . '/../../views/pages/employees/summary.php'; $content = ob_get_clean();
        require __DIR__ . '/../../views/layouts/main.php';
    }
}
