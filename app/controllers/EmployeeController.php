<?php
require_once __DIR__ . '/../models/Employee.php';

class EmployeeController {
    private Employee $employee;
    public function __construct(PDO $db) { $this->employee = new Employee($db); }

    public function index() {
        $title = 'Data Pegawai';
        $employees = $this->employee->all();
        ob_start();
        require __DIR__ . '/../../views/pages/employees/index.php';
        $content = ob_get_clean();
        require __DIR__ . '/../../views/layouts/main.php';
    }

    public function create() {
        $title = 'Tambah Pegawai';
        ob_start();
        require __DIR__ . '/../../views/pages/employees/create.php';
        $content = ob_get_clean();
        require __DIR__ . '/../../views/layouts/main.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: /employees'); exit; }
        $this->employee->create($_POST);
        header('Location: /employees');
        exit;
    }
}
