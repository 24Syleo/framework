<?php

use Syleo24\Framework\entity\User;

$user = $_SESSION['user'] ?? null;
?>

<?php if (!$user instanceof User): ?>
    <h1>Bienvenue sur l'application Livraison</h1>
    <div class="container">
        <p>Connectez-vous pour profiter de toutes les fonctionnalités.</p>
        <a href="/login" class="link"><i class="fa-solid fa-edit"></i> Se connecter</a>
    </div>
<?php else: ?>
    <div class="container">
        <h1><?= $user->getUsername() ?></h1>
        <address class="address-container">
            <div class="address-item">
                <i class="fas fa-envelope"></i>
                <a href="mailto:<?= $user->getEmail() ?>" class="address-text"><?= $user->getEmail() ?></a>
            </div>

            <div class="address-item">
                <i class="fas fa-phone"></i>
                <a href="tel:<?= $user->getPhone() ?>" class="address-text"><?= $user->getPhone() ?></a>
            </div>
            <div class="address-item">
                <i class="fa-solid fa-edit"></i>
                <a href="/<?= $user->getRole() ?>/<?= $user->getId() ?>">Edit</a>
            </div>
            <div class="address-item">
                <i class="fa fa-sign-out"></i>
                <a href="/logout" class="link">Logout</a>
            </div>
        </address>
    </div>
<?php endif; ?>