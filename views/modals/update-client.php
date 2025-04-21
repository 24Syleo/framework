<div id="modalUpdate" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2><?= $client->getUsername() ?></h2>
        </div>
        <div class="modal-body">
            <form id="updateClient">
                <input type="hidden" name="id" id="id" value="<?= $client->getId() ?>">
                <input type="text" name="username" id="username" placeholder="<?= $client->getUsername() ?>"
                    value="<?= $client->getUsername() ?>">
                <span class="response"></span>
                <input type="email" name="email" id="email" placeholder="<?= $client->getEmail() ?>"
                    value="<?= $client->getEmail() ?>">
                <span class="response"></span>
                <input type="text" name="phone" id="phone" placeholder="<?= $client->getPhone() ?>"
                    value="<?= $client->getPhone() ?>">
                <span class="response"></span>
                <div>
                    <button type="submit" class="btnVaild" id="submit">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>