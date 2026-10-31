<h2><?= $editing ? 'Edit User' : 'Tambah User' ?></h2>
<?php if (!empty($_SESSION['flash'])): ?><div class="notice"><?= htmlspecialchars($_SESSION['flash']); unset($_SESSION['flash']); ?></div><?php endif; ?>
<form method="POST" action="<?= $editing ? '/users/update' : '/users/store' ?>" class="data-form">
<?php if($editing): ?><input type="hidden" name="id" value="<?= (int)$user['id'] ?>"><?php endif; ?>
<label>Username</label><input name="username" maxlength="100" value="<?= htmlspecialchars($user['username']) ?>" required>
<label>Password <?= $editing ? '(kosongkan jika tidak ingin mengubah)' : '' ?></label><input type="password" name="password" <?= $editing ? '' : 'required' ?> minlength="4" autocomplete="new-password">
<div class="form-actions"><button type="submit">Simpan</button><a class="button secondary" href="/users">Kembali</a></div>
</form>
