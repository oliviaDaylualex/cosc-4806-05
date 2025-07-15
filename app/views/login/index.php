<?php
$error    = $error    ?? '';
$username = $username ?? '';
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="/public/css/style.css">
	<title>Login</title>
</head>
<body>
	<h2>Login</h2>
	<?php if ($error): ?>
		<p class="error"><?= htmlspecialchars($error) ?></p>
	<?php endif; ?>

	<form method="post" action="/Verify">
		<label>Username</label>
		<input
			type="text"
			name="username"
			required
			value="<?= htmlspecialchars($username) ?>"
		>

		<label>Password</label>
		<input type="password" name="password" required>

		<button type="submit">Login</button>
	</form>

	<p>No account ? <a href="/Register">Register here</a></p>
</body>
</html>
