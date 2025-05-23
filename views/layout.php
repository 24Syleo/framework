<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= $_SESSION['csrf_token'] ?? '' ?>">
    <title><?= $title ?? 'Mon App' ?></title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/style-mobile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <script src="/js/main.js" type="module"></script>
    <script src="https://kit.fontawesome.com/155a809a95.js" crossorigin="anonymous"></script>
</head>

<?php
$page = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

// S'assurer que $page[0] a une valeur
if (empty($page[0])) {
    $page[0] = 'index';
}
?>

<body data-page="<?= e($page[0]) ?>">
    <?php include_once 'partials/navbar.php' ?>
    <?php include_once 'partials/flashmessage.php' ?>
    <main>
        <?= $content ?>
    </main>
</body>

</html>