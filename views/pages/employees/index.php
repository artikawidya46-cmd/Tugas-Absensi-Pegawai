<h2>Data Pegawai</h2>
<p><a class="button" href="/employees/create">+ Tambah Pegawai</a></p>
<table>
<thead><tr><th>No</th><th>NIP</th><th>Nama</th><th>Departemen</th><th>Jabatan</th></tr></thead>
<tbody>
<?php if (!$employees): ?><tr><td colspan="5">Belum ada data pegawai.</td></tr><?php endif; ?>
<?php foreach ($employees as $i => $employee): ?>
<tr>
<td><?= $i + 1 ?></td>
<td><?= htmlspecialchars($employee['employee_number']) ?></td>
<td><?= htmlspecialchars($employee['name']) ?></td>
<td><?= htmlspecialchars($employee['department']) ?></td>
<td><?= htmlspecialchars($employee['position']) ?></td>
</tr>
<?php endforeach; ?>
</tbody></table>
