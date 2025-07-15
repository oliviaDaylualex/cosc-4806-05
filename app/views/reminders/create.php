<?php require __DIR__ . '/../templates/header.php'; ?>

<div class="container">
  <div class="card reminder-card shadow p-4" style="max-width:400px; margin:6rem auto 0 auto;">
    <h2 class="mb-4 text-center">Create a Reminder</h2>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" action="/reminders/create">
      <div class="mb-3">
        <label for="subject" class="form-label">Subject</label>
        <input
          type="text"
          class="form-control"
          name="subject"
          id="subject"
          required
          value="<?= htmlspecialchars($subject ?? '') ?>"
          autofocus
        >
      </div>
      <button type="submit" class="btn btn-primary w-100">Save</button>
    </form>

    <p class="mt-3 text-center">
      <a href="/reminders">Back to list</a>
    </p>
  </div>
</div>

<?php require __DIR__ . '/../templates/footer.php'; ?>