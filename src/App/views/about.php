
<?php $this->resolve("partials/_header.php"); ?>

<!-- Start Main Content Area -->
<section
        class="container mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded"
>
    <!-- Page Title -->
    <h3>About Page</h3>

    <hr />

    <!-- Escaping Data -->
    <p> <?php echo $this->title ?></p>
    <p> <?php echo e($this->data['title']) ?></p>
    <p>Escaping Data: <?php echo e($this->data['dangerousData']) ?></p>
</section>
<!-- End Main Content Area -->

<?php $this->resolve("partials/_footer.php"); ?>

</body>

</html>

