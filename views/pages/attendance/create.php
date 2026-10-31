<h2>Catat Absensi Pegawai</h2>
<?php if (!$employees): ?><p>Data pegawai masih kosong. Tambahkan pegawai terlebih dahulu.</p><a href="/employees/create">Tambah Pegawai</a>
<?php else: ?>
<form method="POST" action="/attendance/store">
<label>Pegawai</label><select name="employee_id" required><option value="">-- Pilih Pegawai --</option>
<?php foreach ($employees as $employee): ?><option value="<?= (int)$employee['id'] ?>"><?= htmlspecialchars($employee['employee_number'] . ' - ' . $employee['name']) ?></option><?php endforeach; ?></select>
<label>Tanggal</label><input type="date" name="attendance_date" value="<?= date('Y-m-d') ?>" required>
<label>Jam Masuk</label><input type="time" name="check_in">
<label>Jam Keluar</label><input type="time" name="check_out">
<label>Status</label><select name="status"><option>Hadir</option><option>Izin</option><option>Sakit</option><option>Alpa</option></select>
<label>Catatan</label><textarea name="note"></textarea><button type="submit">Simpan Absensi</button> <a href="/attendance">Kembali</a>
</form><?php endif; ?>
