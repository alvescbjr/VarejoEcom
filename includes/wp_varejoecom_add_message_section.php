<?php 

    if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?= $_SESSION['type']; ?>">
            <?= __($_SESSION['message'], 'wp_varejoecom'); ?>
        </div>
<?php endif; ?>
