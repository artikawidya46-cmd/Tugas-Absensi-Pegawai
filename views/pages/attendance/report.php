<h2>Laporan Kehadiran</h2>
<form method="GET" action="/attendance/report" class="filters">
<label>Dari tanggal</label><input type="date" name="from" value="<?= htmlspecialchars($filters['from']) ?>">
<label>Sampai tanggal</label><input type="date" name="to" value="<?= htmlspecialchars($filters['to']) ?>">
<label>Pegawai</label><select name="employee_id"><option value="">Semua Pegawai</option><?php foreach ($employees as $employee): ?><option value="<?= (int)$employee['id'] ?>" <?= (string)$filters['employee_id'] === (string)$employee['id'] ? 'selected' : '' ?>><?= htmlspecialchars($employee['employee_number'].' - '.$employee['name']) ?></option><?php endforeach; ?></select>
<label>Status</label><select name="status"><option value="">Semua Status</option><?php foreach (['Hadir','Izin','Sakit','Alpa'] as $status): ?><option value="<?= $status ?>" <?= $filters['status'] === $status ? 'selected' : '' ?>><?= $status ?></option><?php endforeach; ?></select>
<button type="submit">Filter</button> <a href="/attendance/report">Reset</a>
</form>
<p><button type="button" onclick="window.print()">Cetak / Simpan PDF</button></p>
<table><thead><tr><th>No</th><th>Tanggal</th><th>NIP</th><th>Nama Pegawai</th><th>Departemen</th><th>Jam Masuk</th><th>Jam Keluar</th><th>Status</th><th>Catatan</th></tr></thead><tbody>
<?php if (!$attendances): ?><tr><td colspan="9">Tidak ada data sesuai filter.</td></tr><?php endif; ?>
<?php foreach ($attendances as $i => $row): ?><tr><td><?= $i+1 ?></td><td><?= htmlspecialchars($row['attendance_date']) ?></td><td><?= htmlspecialchars($row['employee_number']) ?></td><td><?= htmlspecialchars($row['name']) ?></td><td><?= htmlspecialchars($row['department']) ?></td><td><?= htmlspecialchars($row['check_in'] ?? '-') ?></td><td><?= htmlspecialchars($row['check_out'] ?? '-') ?></td><td><?= htmlspecialchars($row['status']) ?></td><td><?= htmlspecialchars($row['note'] ?? '-') ?></td></tr><?php endforeach; ?>
</tbody></table>
