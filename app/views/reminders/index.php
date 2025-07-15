<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=1024">
  <link rel="stylesheet" href="/public/css/style.css">
  <title>My Alerts</title>
</head>
<body>
  <div class="container">
    <h2>My Reminders</h2>
    <p style="text-align:center;">
      <a class="button-link" href="/reminders/create">+ Add Reminder</a>
    </p>

    <?php if (empty($list)): ?>
      <p style="text-align:center;">No reminders found.</p>
    <?php else: ?>
      <ul class="reminder-list">
        <?php foreach ($list as $note): ?>
          <li>
            <?= htmlspecialchars($note['subject']) ?>
            <?php if (!$note['completed']): ?>
              <a href="/reminders/complete/<?= $note['id'] ?>">[Complete]</a>
            <?php else: ?>
              <span class="completed">[Completed]</span>
            <?php endif; ?>
            <a href="/reminders/delete/<?= $note['id'] ?>"
               onclick="return confirm('Delete this reminder?')">[Delete]</a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <div style="text-align:center; margin-top: 2rem;">
      <a class="button-link" href="/home">Back to Home</a>
    </div>
  </div>
</body>
</html>
