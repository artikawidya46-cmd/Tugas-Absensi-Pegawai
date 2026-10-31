<h2><?= $editing ? 'Edit Produk' : 'Tambah Produk' ?></h2>
<?php if (!empty($_SESSION['flash'])): ?><div class="notice"><?= htmlspecialchars($_SESSION['flash']); unset($_SESSION['flash']); ?></div><?php endif; ?>
<form method="POST" action="<?= $editing ? '/products/update' : '/products/store' ?>" class="data-form">
<?php if($editing): ?><input type="hidden" name="id" value="<?= (int)$product['id'] ?>"><?php endif; ?>
<label>Nama Produk</label><input name="name" maxlength="150" value="<?= htmlspecialchars($product['name']) ?>" required>
<label>Deskripsi</label><textarea name="description" rows="3"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
<label>Harga (Rp)</label><input type="number" name="price" min="0" step="0.01" value="<?= htmlspecialchars((string)$product['price']) ?>" required>
<label>Stok</label><input type="number" name="stock" min="0" step="1" value="<?= (int)$product['stock'] ?>" required>
<div class="form-actions"><button type="submit">Simpan</button><a class="button secondary" href="/products">Kembali</a></div>
</form>
