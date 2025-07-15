<?php
require __DIR__ . '/../templates/headerPublic.php'; 
$error    = $error    ?? '';
$username = $username ?? '';
?>

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
  <div class="card login-card shadow p-4 w-100" style="max-width:400px;">
    <h2 class="mb-4 text-center">Login</h2>
    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post" action="/Verify">
      <div class="mb-3">
        <label class="form-label" for="username">Username</label>
        <input
          type="text"
          class="form-control"
          name="username"
          id="username"
          required
          value="<?= htmlspecialchars($username) ?>"
          autocomplete="username"
        >
      </div>
      <div class="mb-3">
        <label class="form-label" for="password">Password</label>
        <div class="input-group">
          <input
            type="password"
            class="form-control"
            name="password"
            id="password"
            required
            autocomplete="current-password"
          >
          <button type="button" class="btn btn-outline-secondary" tabindex="-1" onclick="togglePassword()" title="Show Password">
            <span id="pw-icon">Reveal</span>
          </button>
        </div>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <p class="mt-3 text-center">No account? <a href="/Register">Register here</a></p>
  </div>
</div>

<script>
  function togglePassword() {
    const input = document.getElementById("password");
    input.type = input.type === "password" ? "text" : "password";
    document.getElementById("pw-icon").textContent = input.type === "password" ? "Hide" : "Show";
  }
</script>

<?php require __DIR__ . '/../templates/footer.php'; ?>