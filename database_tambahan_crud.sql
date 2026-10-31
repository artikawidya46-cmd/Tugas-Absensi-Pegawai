-- Jalankan pada database mvc_absensi yang sudah digunakan aplikasi pegawai.
USE mvc_absensi;
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT NULL,
    price DECIMAL(12,2) NOT NULL DEFAULT 0,
    stock INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Tabel users tidak perlu dibuat ulang karena sudah digunakan untuk login.
