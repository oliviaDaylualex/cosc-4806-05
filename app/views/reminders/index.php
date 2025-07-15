<?php require __DIR__ . '/../templates/header.php'; ?>

<div class="container my-5">
  <h2 class="text-center mb-4">My Reminders</h2>

  <div class="text-center mb-4">
    <a class="btn btn-success" href="/reminders/create">+ Add Reminder</a>
  </div>

  <?php if (empty($notes)): ?>
    <p class="text-center text-muted">No reminders found.</p>
  <?php else: ?>
    <ul class="list-group mb-4">
      <?php foreach ($notes as $note): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center<?= $note['completed'] ? ' completed' : '' ?>">
          <span>
            <?= htmlspecialchars($note['subject']) ?>
            <?php if ($note['completed']): ?>
              <span class="badge bg-secondary ms-2">Completed</span>
            <?php endif; ?>
          </span>
          <span class="actions">
            <?php if (!$note['completed']): ?>
              <a href="/reminders/complete/<?= $note['id'] ?>" class="btn btn-sm btn-outline-primary me-1">Complete</a>
            <?php endif; ?>
            <a href="/reminders/delete/<?= $note['id'] ?>" class="btn btn-sm btn-outline-danger"
               onclick="return confirm('Delete this reminder?')">Delete</a>
          </span>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <div class="text-center">
    <a class="btn btn-outline-secondary" href="/home">Back to Home</a>
  </div>
</div>

<?php require __DIR__ . '/../templates/footer.php'; ?>