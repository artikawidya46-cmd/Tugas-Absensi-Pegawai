<h2>Tambah Pegawai</h2>
<form method="POST" action="/employees/store">
    <label>NIP</label><input name="employee_number" required>
    <label>Nama Pegawai</label><input name="name" required>
    <label>Departemen</label><input name="department" required>
    <label>Jabatan</label><input name="position" required>
    <button type="submit">Simpan</button>
    <a href="/employees">Kembali</a>
</form>
