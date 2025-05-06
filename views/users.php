<h1>Liste d'utilisateurs</h1>

<div class="card-grid">
    <?php foreach ($users as $user): ?>
        <div class="card">
            <h3>Nom : <?= e($user->getUsername()) ?></h3>
            <p>Email : <?= e($user->getEmail()) ?></p>
            <p>Rôle : <?= e($user->getRole()) ?></p>
            <a href="/user/<?= e($user->getId()) ?>" class="text-success"><i class="fa-solid fa-edit"></i></a>
            <a href="#" class="text-error"><i class="fa-solid fa-trash"></i></a>
        </div>
    <?php endforeach; ?>
</div>

<button class="btnAdd"><i class="fa-solid fa-plus"></i></button>
<?php include_once 'modals/add-user.php' ?>