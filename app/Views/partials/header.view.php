<?php
// app/Views/partials/header.view.php
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title><?= $pageTitle ?? 'Staj Başvuru Sistemi' ?></title>
    <style>
        /* Genel Sayfa Stilleri */
        body { 
            font-family: sans-serif; 
            background-color: #f8f9fa; 
            padding-top: 70px; /* Navbar için üstten boşluk */
        }
        
        /* Önceki stilleriniz burada korunuyor */
        .container { width: 90%; max-width: 960px; margin: 20px auto; padding: 20px; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border-radius: 8px; }
        h1 { text-align: center; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 20px;}
        .error { color: red; text-align: center; margin-bottom: 15px; }

        /* Bootstrap'in bazı stillerini ezen veya tamamlayan özel stiller */
        .login-box { margin-top: 100px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/stajyer-basvuru-sistemi/public">Staj Başvuru Sistemi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true): ?>
          <li class="nav-item">
            <a class="nav-link" href="/stajyer-basvuru-sistemi/public/admin/dashboard">Yönetim Paneli</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/stajyer-basvuru-sistemi/public/logout">Çıkış Yap</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link btn btn-primary text-white px-3" href="/stajyer-basvuru-sistemi/public/login">Admin Girişi</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
    <?php // Flash mesajı varsa göster ve session'dan sil
    if (isset($_SESSION['flash_message'])): 
        $message = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
    ?>
        <div class="alert alert-<?= $message['type'] === 'error' ? 'danger' : $message['type'] ?>" role="alert">
            <?= $message['text'] ?>
        </div>
    <?php endif; ?>