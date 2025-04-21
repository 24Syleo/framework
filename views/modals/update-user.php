<div id="modalUpdate" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2><?= $user->getUsername() ?></h2>
        </div>
        <div class="modal-body">
            <form id="updateUser">
                <input type="hidden" name="id" id="id" value="<?= $user->getId() ?>">
                <input type="text" name="username" id="username" placeholder="<?= $user->getUsername() ?>"
                    value="<?= $user->getUsername() ?>">
                <span class="response"></span>
                <input type="email" name="email" id="email" placeholder="<?= $user->getEmail() ?>"
                    value="<?= $user->getEmail() ?>">
                <span class="response"></span>
                <input type="text" name="phone" id="phone" placeholder="<?= $user->getPhone() ?>"
                    value="<?= $user->getPhone() ?>">
                <span class="response"></span>
                <?php if ($user->isAdmin()): ?>
                    <select name="role" id="role">
                        <option value="user" <?= $user->getRole() === 'user' ? 'selected' : '' ?>>Utilisateur</option>
                        <option value="admin" <?= $user->getRole() === 'admin' ? 'selected' : '' ?>>Administrateur</option>
                    </select>
                    <span class="response"></span>
                <?php endif; ?>
                <div>
                    <button type="submit" class="btnVaild" id="submit">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>