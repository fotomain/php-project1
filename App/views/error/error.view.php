<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>


<section>
    <?php global $modelError; ?>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">
            <?= $modelError->getErrorMessage()->code; ?> Error
        </div>
        <p class="text-center text-2xl mb-4">
            <?= $modelError->getErrorMessage()->message; ?>
        </p>
        <a href="/listings" class="block text-center">Go Back To Listings</a>
    </div>
</section>


<?php loadPartial('footer'); ?>

