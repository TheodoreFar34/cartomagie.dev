<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,700">
    <title>Mon super projet</title>
    <link rel="stylesheet" href="css/app.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="inc/app.js"></script>
</head>
<body>
    <section class="section" style="font-size:40px;">
        <span class="loader loader-circles"></span>
        Chargement...
    </section>
    <div class="site-container">
    <div class="site-pusher">
    <header class="header">
        <a href="#" class="header__icon menu-icon-svg" id="header__icon">
            <span></span>
            <svg x="0" y="0" width="54px" height="54px" viewBox"0 0 54 54">
                <path d="M16.500,27.000 C16.500,27.000 24.939,27.000 38.500,27.000 C52.061,27.000 49.945,15.648 46.510,11.367 C41.928,5.656 34.891,2.000 27.000,2.000 C13.193,2.000 2.000,13.193 2.000,27.000 C2.000,40.807 13.193,52.000 27.000,52.000 C40.807,52.000 52.000,40.807 52.000,27.000 C52.000,13.000 40.837,2.000 27.000,2.000 "</path>
            </svg>
        </a>
        <a href="#" class="header__logo">Logo</a>
        <nav class="menu">
            <?php if (isset($_SESSION['auth'])): ?>
            <a href="logout.php">Se déconnecter</a></li>
            <?php else: ?>
                <a href="register.php">S'inscrire</a>
                <a href="login.php">Se connecter</a>
            <?php endif; ?>
            <a href="subscribe.php">Boutique</a>
        </nav>
    </header>
<div class="site-content">
    <div class="container">
        <?php if(Session::getInstance()->hasFlashes()): ?>
            <?php foreach (Session::getInstance()->getFlashes() as $type => $message): ?>
                <div class="alert alert-<?= $type; ?>">
                    <?= $message; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
