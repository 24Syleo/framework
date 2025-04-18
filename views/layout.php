<!-- /views/layout.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Mon App' ?></title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/main.js" type="module"></script>
</head>

<?php
$page = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

// S'assurer que $page[0] a une valeur
if (empty($page[0])) {
    $page[0] = 'index';
}
?>

<body data-page="<?= htmlspecialchars($page[0], ENT_QUOTES, 'UTF-8') ?>">
    <section>
        <?= $content ?>
    </section>
</body>

</html>