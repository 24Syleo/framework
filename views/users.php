<h1>Listes d'utilisateur</h1>

<div class="card-grid">
    <?php foreach ($users as $user): ?>
        <div class="card">
            <h3>Nom : <?= $user->getUsername() ?></h3>
            <p>Email : <?= $user->getEmail() ?></p>
            <p>Rôle : <?= $user->getRole() ?></p>
            <a href="#" class="btnEdit"><i class="fa-solid fa-edit"></i></a>
            <a href="#" class="btnDelete"><i class="fa-solid fa-trash"></i></a>
        </div>
    <?php endforeach; ?>
</div>

<button class="btnAdd"><i class="fa-solid fa-plus"></i></button>
<?php include_once 'modals/add-user.php' ?>