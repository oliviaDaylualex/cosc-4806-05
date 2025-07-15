
<?php
$errors   = $errors   ?? [];
$username = $username ?? '';
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="public/css/style.css">
  <title>Register</title>
</head>
<body>
  <h2>Create Account</h2>
  <?php if ($errors): ?>
    <ul class="errors">
      <?php foreach ($errors as $e): ?>
        <li><?= htmlspecialchars($e) ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  <form method="post" action="/Register">
    <label>Username</label>
    <input type="text" name="username" required
           value="<?= htmlspecialchars($username) ?>">

    <label>Password</label>
    <input type="password" name="password" required>
    <small>Password ≥8 chars, with uppercase, number & special character.</small>

    <button type="submit">Register</button>
  </form>
  <p>Already have one? <a href="/Login">Login here</a></p>
</body>
</html>
