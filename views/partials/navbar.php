<?php

use Syleo24\Framework\entity\User;

$user = $_SESSION['user'] ?? null;

?>

<nav>
    <div class="nav-logo">
        <img src="/images/icon-48x48.png" alt="logo entreprise">
        <a href="/">
            <?= $user instanceof User ? htmlspecialchars($user->getUsername()) : "App Livraison" ?>
        </a>
    </div>
    <button id="btnMenu"><i class="fa-solid fa-bars"></i></button>
</nav>

<div id="menu">
    <a href="/" class="link">Accueil</a>

    <?php if (!$user instanceof User): ?>
        <a href="/login" class="link">Se connecter</a>
    <?php else: ?>
        <a href="/logout" class="link">Se déconnecter</a>

        <?php if ($user->isAdmin()): ?>
            <a href="/users" class="link">Utilisateurs</a>
            <a href="/commandes" class="link">Commandes</a>
            <a href="/clients" class="link">Clients</a>
            <a href="/adresses" class="link">Adresses</a>
        <?php endif; ?>

        <?php if ($user->isUser()): ?>
            <a href="/user/<?= $user->getId() ?>" class="link">Profil Utilisateur</a>
        <?php endif; ?>

        <?php if ($user->isClient()): ?>
            <a href="/mes-commandes" class="link">Mes Commandes</a>
        <?php endif; ?>
    <?php endif; ?>
</div>