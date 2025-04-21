<h1><?= $client->getUsername() ?></h1>
<address class="address-container">
    <div class="address-item">
        <i class="fas fa-envelope"></i>
        <a href="mailto:<?= $client->getEmail() ?>" class="address-text"><?= $client->getEmail() ?></a>
    </div>

    <div class="address-item">
        <i class="fas fa-phone"></i>
        <a href="tel:<?= $client->getPhone() ?>" class="address-text"><?= $client->getPhone() ?></a>
    </div>
</address>

<button class="btnAdd"><i class="fa-solid fa-edit"></i></button>
<?php include_once 'modals/update-client.php' ?>