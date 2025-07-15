<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=1024">
  <title>Create Reminder</title>
  <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
  

  <div class="container">
    <h2>Create a Reminder</h2>

    <?php if (!empty($error)): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" action="/reminders/create">
      <label>Subject</label>
      <input
        type="text"
        name="subject"
        required
        value="<?= htmlspecialchars($subject ?? '') ?>"
      >
      <button type="submit">Save</button>
    </form>

    <p><a href="/reminders">Back to list</a></p>
  </div>

 
  </script>
</body>
</html>
