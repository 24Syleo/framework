<h1>Liste clients</h1>

<div class="card-grid">
    <?php foreach ($clients as $client): ?>
        <div class="card">
            <h3>Nom : <?= e($client->getUsername()) ?></h3>
            <p>Email : <?= e($client->getEmail()) ?></p>
            <p>Rôle : <?= e($client->getRole()) ?></p>
            <a href="/client/<?= e($client->getId()) ?>" class="text-success"><i class="fa-solid fa-edit"></i></a>
            <a href="#" class="text-error"><i class="fa-solid fa-trash"></i></a>
        </div>
    <?php endforeach; ?>
</div>

<button class="btnAdd"><i class="fa-solid fa-plus"></i></button>
<?php include_once 'modals/add-client.php' ?>