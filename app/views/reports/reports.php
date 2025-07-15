<?php require __DIR__ . '/../templates/header.php'; ?>

<div class="container my-5">
  <h2 class="mb-4">Admin Reports</h2>


  <div class="card mb-3">
    <div class="card-header bg-primary text-white">All Reminders</div>
    <div class="card-body">
      <?php if (!empty($data['allReminders'])): ?>
    <ul class="list-group">
      <?php foreach ($data['allReminders'] as $reminder): ?>
        <li class="list-group-item">
          <span class="fw-bold"><?= htmlspecialchars($reminder['username']) ?>:</span>
          <?= htmlspecialchars($reminder['subject']) ?>
          <?php if (!empty($reminder['completed'])): ?>
            <span class="badge bg-success ms-2">Completed</span>
          <?php else: ?>
            <span class="badge bg-warning text-dark ms-2">Pending</span>
          <?php endif; ?>
          <small class="text-muted ms-2"><?= $reminder['created_at'] ?></small>
        </li>
      <?php endforeach; ?>
    </ul>

      <?php else: ?>
        <p class="text-muted">No reminders found.</p>
      <?php endif; ?>
    </div>
  </div>


  <div class="card mb-3">
    <div class="card-header bg-success text-white">User with Most Reminders</div>
    <div class="card-body">
      <?php if ($data['mostRemindersUser']): ?>
        <strong><?= htmlspecialchars($data['mostRemindersUser']['username']) ?></strong>
        (<?= $data['mostRemindersUser']['count'] ?> reminders)
      <?php else: ?>
        <span class="text-muted">No reminders found.</span>
      <?php endif; ?>
    </div>
  </div>


  <div class="card mb-3">
    <div class="card-header bg-info text-white">Total Logins by Username</div>
    <div class="card-body">
      <?php if (!empty($data['logins'])): ?>
        <div class="mb-3">
          <canvas id="loginChart" width="400" height="140"></canvas>
        </div>
        <ul class="list-group list-group-flush">
          <?php foreach ($data['logins'] as $login): ?>
            <li class="list-group-item">
              <span class="fw-bold"><?= htmlspecialchars($login['username']) ?>:</span>
              <?= $login['login_count'] ?> logins
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p class="text-muted">No login data.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
<?php if (!empty($data['logins'])): ?>
const ctx = document.getElementById('loginChart').getContext('2d');
const loginChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_column($data['logins'], 'username')) ?>,
        datasets: [{
            label: 'Total Logins',
            data: <?= json_encode(array_column($data['logins'], 'login_count')) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        plugins: {
          legend: { display: false }
        },
        scales: { y: { beginAtZero: true } }
    }
});
<?php endif; ?>
</script>

<?php require APPROOT . '/views/templates/footer.php'; ?>