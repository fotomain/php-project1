<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>
<?php loadPartial('top-banner'); ?>

<?php global $modelJob; $showData=$modelJob->getCurrentElement()?>

    <section class="container mx-auto p-4 mt-4">
    <div class="rounded-lg shadow-md bg-white p-3">
        <div class="flex justify-between items-center">
            <a class="block p-4 text-blue-700" href="/listings">
                <i class="fa fa-arrow-alt-circle-left"></i>
                Back To Listings
            </a>
            <div class="flex space-x-4 ml-4">
                <a href="/listing/edit/<?=$showData->id ?>"
                   class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded">
                    Edit
                </a>
                <!-- Delete Form === start reload page-->
                <form method="POST" >
                    <input type="hidden" name="_method" value="DELETE" />
                    <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
                        Delete
                    </button>
                </form>
                <!-- End Delete Form -->
            </div>
        </div>
        <div class="p-4">
            <h2 class="text-xl font-semibold"><?= $showData->title ?></h2>
            <p class="text-gray-700 text-lg mt-2">
                <?= $showData->description ?>
            </p>
            <ul class="my-4 bg-gray-100 p-4">
                <li class="mb-2"><strong>Salary:</strong> <?= formatSalary($showData->salary) ?></li>
                <li class="mb-2">
                    <strong>Location:</strong>
                    <?= $showData->city?>,
                    <?= $showData->state?>
                    <span
                        class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2"
                    >Local</span
                    >
                </li>
                <li class="mb-2">

                    <?php if(!empty($showData->tags)) : ?>
                        <strong>Tags:</strong> <span><?= $showData->tags?></span>,
                    <?php endif;?>

                </li>
            </ul>
        </div>
    </div>
</section>

<section class="container mx-auto p-4">
    <h2 class="text-xl font-semibold mb-4">Job Details</h2>
    <div class="rounded-lg shadow-md bg-white p-4">
        <h3 class="text-lg font-semibold mb-2 text-blue-500">
            Job Requirements
        </h3>
        <p>
            <?= $showData->requirements?>
        </p>
        <h3 class="text-lg font-semibold mt-4 mb-2 text-blue-500">Benefits</h3>
        <p><?= $showData->benefits?></p>
    </div>
    <p class="my-5">
        Put "Job Application" as the subject of your email and attach your
        resume.
    </p>
    <a
        href="mailto:<?= $showData->email?>"
        class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium cursor-pointer text-indigo-700 bg-indigo-100 hover:bg-indigo-200"
    >
        Apply Now
    </a>
</section>

<?php loadPartial('bottom-banner'); ?>
<?php loadPartial('footer'); ?>

