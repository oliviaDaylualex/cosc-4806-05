<?php
if (!isset($_SESSION['auth'])) {
    header('Location: /login');
    exit;
}
$isAdmin = (isset($_SESSION['auth']['role']) && $_SESSION['auth']['role'] === 'admin');
$username = $_SESSION['auth']['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="icon" href="/favicon.png">
    <title>Private - COSC 4806</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        body { background: #f8f9fa; }
        .navbar-brand { font-weight: bold; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="/home">Remindly</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if ($isAdmin): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-shield-lock"></i> Admin
            </a>
            <ul class="dropdown-menu" aria-labelledby="adminDropdown">
              <li><a class="dropdown-item" href="/home"><i class="bi bi-house-door"></i> Home</a></li>
              <li><a class="dropdown-item" href="/reports"><i class="bi bi-bar-chart"></i> Reports</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="/reminders"><i class="bi bi-bell"></i> Reminders</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="/home"><i class="bi bi-house-door"></i> Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/reminders"><i class="bi bi-bell"></i> Reminders</a></li>
        <?php endif; ?>
      </ul>

      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($username); ?>
            <?php if ($isAdmin): ?> <span class="badge bg-warning text-dark">Admin</span><?php endif; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            
            <li><a class="dropdown-item text-danger" href="/logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-<?php echo $_SESSION['flash']['type']; ?> alert-dismissible fade show mt-2" role="alert">
      <?php echo $_SESSION['flash']['message']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['flash']); ?>
  <?php endif; ?>