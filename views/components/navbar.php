<nav>
    <a href="/">Dashboard</a><a href="/employees">Data Pegawai</a><a href="/employees/summary">Rekap Pegawai</a><a href="/attendance">Data Absensi</a><a href="/attendance/report">Laporan Kehadiran</a><a href="/users">Data User</a><a href="/products">Data Produk</a>
    <span class="right">Login: <?= htmlspecialchars($_SESSION['username'] ?? '') ?></span><a href="/logout">Logout</a>
</nav>
