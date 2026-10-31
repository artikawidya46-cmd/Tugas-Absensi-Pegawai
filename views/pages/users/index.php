<div class="page-heading"><div><h2>Manajemen User</h2><p class="muted">Kelola akun untuk masuk ke sistem absensi.</p></div><a class="button" href="/users/create">+ Tambah User</a></div>
<?php if (!empty($_SESSION['flash'])): ?><div class="notice"><?= htmlspecialchars($_SESSION['flash']); unset($_SESSION['flash']); ?></div><?php endif; ?>
<input class="table-search" type="search" placeholder="Cari username..." data-table-search="usersTable">
<div class="table-wrap"><table id="usersTable"><thead><tr><th>No</th><th>Username</th><th>Aksi</th></tr></thead><tbody>
<?php if (!$users): ?><tr><td colspan="3">Belum ada user.</td></tr><?php endif; ?>
<?php foreach($users as $i=>$u): ?><tr><td><?= $i+1 ?></td><td><?= htmlspecialchars($u['username']) ?><?php if((int)$u['id']===(int)($_SESSION['user_id']??0)): ?> <span class="tag">Akun aktif</span><?php endif; ?></td><td class="actions"><a class="button small-button" href="/users/edit?id=<?= (int)$u['id'] ?>">Edit</a><form class="inline-form" method="POST" action="/users/delete" onsubmit="return confirm('Yakin ingin menghapus user ini?')"><input type="hidden" name="id" value="<?= (int)$u['id'] ?>"><button class="danger small-button" type="submit">Hapus</button></form></td></tr><?php endforeach; ?>
</tbody></table></div>
