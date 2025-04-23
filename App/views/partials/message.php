<?php

use Framework\Session;

$successMessage = Session::get('success_message');
$errorMessage = Session::get('error_message');

?>

<?php if (null!==$successMessage) : ?>
    <div class="message bg-green-100 p-3 my-3">
        <?= $successMessage; ?>
    </div>
    <?php Session::clear('success_message');?>
<?php endif; ?>

<?php if (null!==$errorMessage) : ?>
    <div class="message bg-red-100 p-3 my-3">
        <?= $errorMessage; ?>
    </div>
    <?php Session::clear('error_message');?>
<?php endif; ?>
