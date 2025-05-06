<div id="modalUpdate" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2><?= e($client->getUsername()) ?></h2>
        </div>
        <div class="modal-body">
            <form id="updateClient">
                <input type="hidden" name="id" id="id" value="<?= e($client->getId()) ?>">
                <input type="text" name="username" id="username" placeholder="<?= e($client->getUsername()) ?>"
                    value="<?= e($client->getUsername()) ?>">
                <span class="response"></span>
                <input type="email" name="email" id="email" placeholder="<?= e($client->getEmail()) ?>"
                    value="<?= e($client->getEmail()) ?>">
                <span class="response"></span>
                <input type="text" name="phone" id="phone" placeholder="<?= e($client->getPhone()) ?>"
                    value="<?= e($client->getPhone()) ?>">
                <span class="response"></span>
                <div>
                    <button type="submit" class="btnVaild" id="submit">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>