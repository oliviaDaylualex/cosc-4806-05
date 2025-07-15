<?php
require_once dirname(__DIR__, 1) . '/templates/header.php';
$username  = $_SESSION['auth']['username'];
$loginTime = $_SESSION['auth']['login_time'];
?>

<div class="container home-center my-5">
  <div class="card shadow p-4 text-center mx-auto" style="max-width:400px;">
    <h2>Hello, <?= htmlspecialchars($username) ?>!</h2>
    <?php if ($loginTime): ?>
      <p class="text-muted">You logged in at <?= date('F j, Y \a\t g:i A', strtotime($loginTime)) ?></p>
    <?php endif; ?>
    <a class="btn btn-primary my-2 w-100" href="/reminders">View Your Reminders</a>
    <a class="btn btn-outline-danger w-100" href="/logout">Logout</a>
  </div>
</div>

<?php require_once dirname(__DIR__, 1) . '/templates/footer.php'; ?>