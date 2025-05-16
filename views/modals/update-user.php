<div id="modalUpdate" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2><?= e($user->getUsername()) ?></h2>
        </div>
        <div class="modal-body">
            <form id="updateUser">
                <input type="hidden" name="id" id="id" value="<?= e($user->getId()) ?>">
                <input type="text" name="username" id="username" placeholder="<?= e($user->getUsername()) ?>"
                    value="<?= e($user->getUsername()) ?>">
                <span class="response"></span>
                <input type="email" name="email" id="email" placeholder="<?= e($user->getEmail()) ?>"
                    value="<?= e($user->getEmail()) ?>">
                <span class="response"></span>
                <input type="text" name="phone" id="phone" placeholder="<?= e($user->getPhone()) ?>"
                    value="<?= e($user->getPhone()) ?>">
                <span class="response"></span>
                <?php if ($admin->isAdmin()): ?>
                    <select name="role" id="role">
                        <option value="user" <?= e($user->getRole()) === 'user' ? 'selected' : '' ?>>Utilisateur</option>
                        <option value="admin" <?= e($user->getRole()) === 'admin' ? 'selected' : '' ?>>Administrateur
                        </option>
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