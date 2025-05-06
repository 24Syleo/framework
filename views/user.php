<h1><?= e($user->getUsername()) ?></h1>
<address class="address-container">
    <div class="address-item">
        <i class="fas fa-lock"></i>
        <span class="address-text"><?= e($user->getRole()) ?></span>
    </div>

    <div class="address-item">
        <i class="fas fa-envelope"></i>
        <a href="mailto:<?= e($user->getEmail()) ?>" class="address-text"><?= e($user->getEmail()) ?></a>
    </div>

    <div class="address-item">
        <i class="fas fa-phone"></i>
        <a href="tel:<?= e($user->getPhone()) ?>" class="address-text"><?= e($user->getPhone()) ?></a>
    </div>
</address>

<button class="btnAdd"><i class="fa-solid fa-edit"></i></button>
<?php include_once 'modals/update-user.php' ?>