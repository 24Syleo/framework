<h1><?= $user->getUsername() ?></h1>
<address class="address-container">
    <div class="address-item">
        <i class="fas fa-lock"></i>
        <span class="address-text"><?= $user->getRole() ?></span>
    </div>

    <div class="address-item">
        <i class="fas fa-envelope"></i>
        <a href="mailto:<?= $user->getEmail() ?>" class="address-text"><?= $user->getEmail() ?></a>
    </div>
</address>

<button class="btnAdd"><i class="fa-solid fa-edit"></i></button>
<?php include_once 'modals/update-user.php' ?>