<h2>Rekap Pegawai</h2><p>Ringkasan jumlah catatan kehadiran setiap pegawai.</p>
<p><button type="button" onclick="window.print()">Cetak Rekap</button></p>
<table><thead><tr><th>No</th><th>NIP</th><th>Nama</th><th>Departemen</th><th>Jabatan</th><th>Total Absensi</th><th>Hadir</th><th>Izin</th><th>Sakit</th><th>Alpa</th></tr></thead><tbody>
<?php if (!$summaries): ?><tr><td colspan="10">Belum ada data pegawai.</td></tr><?php endif; ?>
<?php foreach ($summaries as $i => $row): ?><tr><td><?= $i+1 ?></td><td><?= htmlspecialchars($row['employee_number']) ?></td><td><?= htmlspecialchars($row['name']) ?></td><td><?= htmlspecialchars($row['department']) ?></td><td><?= htmlspecialchars($row['position']) ?></td><td><?= (int)$row['total_absensi'] ?></td><td><?= (int)$row['hadir'] ?></td><td><?= (int)$row['izin'] ?></td><td><?= (int)$row['sakit'] ?></td><td><?= (int)$row['alpa'] ?></td></tr><?php endforeach; ?>
</tbody></table>
