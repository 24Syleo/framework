<h1><?= e($client->getUsername()) ?></h1>
<address class="address-container">
    <div class="address-item">
        <i class="fas fa-envelope"></i>
        <a href="mailto:<?= e($client->getEmail()) ?>" class="address-text"><?= e($client->getEmail()) ?></a>
    </div>

    <div class="address-item">
        <i class="fas fa-phone"></i>
        <a href="tel:<?= e($client->getPhone()) ?>" class="address-text"><?= e($client->getPhone()) ?></a>
    </div>
</address>

<button class="btnAdd"><i class="fa-solid fa-edit"></i></button>
<?php include_once 'modals/update-client.php' ?>