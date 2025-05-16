<?php if (empty($user->getSecret())): ?>
    <h1>Activation double authentification</h1>
<?php else: ?>
    <h1>Double authentification</h1>
<?php endif; ?>

<div class="container">
    <?php if (empty($user->getSecret())): ?>
        <div class="container">

            <div>
                <input type="password" value="<?= e($secret) ?>" id="text-to-copy">
                <input type="checkbox" id="viewSecret">
                <label for="viewSecret" id="labelViewSecret"></label>
            </div>
            <div>
                <button id="text_code">Copier dans presse papier</button>
            </div>
            <img src="<?= e($qr_code) ?>">
        </div>
    <?php endif; ?>
    <div class="container">

        <form id="tfa">
            <input type="hidden" name="secret" value="<?= e($secret) ?>">
            <input type="text" name="tfa_code" id="tfa_code" placeholder="Vérification code">
            <span class="response"></span>
            <div>
                <button type="submit" class="btnVaild" id="submit">Ajouter</button>
            </div>
        </form>
    </div>
</div>