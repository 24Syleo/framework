<?php if (empty($user->getSecret())): ?>
    <h1>Activation double authentification</h1>
<?php else: ?>
    <h1>Double authentification</h1>
<?php endif; ?>

<div class="container">
    <?php if (empty($user->getSecret())): ?>
        <p>code secret: <?= $secret ?></p>
        <img src="<?= $qr_code ?>">
    <?php endif; ?>
    <form id="tfa">
        <input type="hidden" name="secret" value="<?= $secret ?>">
        <input type="text" name="tfa_code" id="tfa_code" placeholder="Vérification code">
        <span class="response"></span>
        <div>
            <button type="submit" class="btnVaild" id="submit">Ajouter</button>
        </div>
    </form>
</div>