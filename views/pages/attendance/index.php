<h2>Data Absensi</h2>
<p><a class="button" href="/attendance/create">+ Catat Absensi</a> <a class="button" href="/attendance/report">Lihat Laporan</a></p>
<table><thead><tr><th>No</th><th>Tanggal</th><th>NIP</th><th>Nama Pegawai</th><th>Jam Masuk</th><th>Jam Keluar</th><th>Status</th><th>Catatan</th><th>Aksi</th></tr></thead><tbody>
<?php if (!$attendances): ?><tr><td colspan="9">Belum ada data absensi.</td></tr><?php endif; ?>
<?php foreach ($attendances as $i => $item): ?>
<tr>
<td><?= $i + 1 ?></td><td><?= htmlspecialchars($item['attendance_date']) ?></td><td><?= htmlspecialchars($item['employee_number']) ?></td><td><?= htmlspecialchars($item['name']) ?></td><td><?= htmlspecialchars($item['check_in'] ?? '-') ?></td><td><?= htmlspecialchars($item['check_out'] ?? '-') ?></td><td><?= htmlspecialchars($item['status']) ?></td><td><?= htmlspecialchars($item['note'] ?? '-') ?></td>
<td><?php if ($item['status'] === 'Hadir' && empty($item['check_out'])): ?>
<form method="POST" action="/attendance/check-out" class="inline-form" onsubmit="return confirm('Catat jam keluar sekarang?')"><input type="hidden" name="attendance_id" value="<?= (int)$item['id'] ?>"><button type="submit" class="small-button">Jam Keluar</button></form>
<?php else: ?><span class="muted">Selesai</span><?php endif; ?></td>
</tr>
<?php endforeach; ?>
</tbody></table>
