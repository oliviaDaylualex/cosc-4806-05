<?php require __DIR__ . '/../templates/headerPublic.php'; ?>
<?php
$errors   = $errors   ?? [];
$username = $username ?? '';
?>

<div class="container">
  <div class="card register-card shadow p-4" style="max-width:400px;margin:6rem auto 0 auto;">
    <h2 class="mb-4 text-center">Create Account</h2>
    <?php if ($errors): ?>
      <div class="alert alert-danger">
        <ul class="mb-0">
          <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <form method="post" action="/Register">
      <div class="mb-3">
        <label class="form-label" for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username"
               required value="<?= htmlspecialchars($username) ?>" autocomplete="username">
      </div>
      <div class="mb-3">
        <label class="form-label" for="password">Password</label>
        <div class="input-group">
          <input type="password" class="form-control" name="password" id="password"
                 required autocomplete="new-password">
          <button type="button" class="btn btn-outline-secondary" tabindex="-1" onclick="togglePassword()" title="Show Password">
            <span id="pw-icon">👁️</span>
          </button>
        </div>
        <small class="form-text text-muted">
          Password ≥8 chars, with uppercase, number &amp; special character.
        </small>
      </div>
      <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
    <p class="mt-3 text-center">Already have one? <a href="/Login">Login here</a></p>
  </div>
</div>

<script>
  function togglePassword() {
    const input = document.getElementById("password");
    input.type = input.type === "password" ? "text" : "password";
    document.getElementById("pw-icon").textContent = input.type === "password" ? "👁️" : "🙈";
  }
</script>

<?php require __DIR__ . '/../templates/footer.php'; ?>