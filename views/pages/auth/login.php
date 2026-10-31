<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Login</title><link rel="stylesheet" href="/css/style.css"></head>
<body><main class="login">
<h2>Login Sistem Absensi</h2>
<?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
<form method="POST" action="/login">
<label>Username</label><input name="username" required>
<label>Password</label><input type="password" name="password" required>
<button type="submit">Login</button>
</form></main></body></html>
