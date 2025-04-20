<?php

use Syleo24\Framework\util\FlashMessage;

$flash = FlashMessage::get();
if ($flash): ?>
    <div class="flash-message <?= $flash['type'] ?>">
        <?= $flash['message'] ?>
    </div>
<?php endif; ?>