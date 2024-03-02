<?php $this->view('includes/header') ?>
    <div class="container-fluid p-4 shadow">
        <?php $this->view('includes/b_crumb') ?>

        <div class="card-group justify-content-center">

            <?php if($schools) : ?>
                <?php foreach ($schools as $school ): ?>

                <?php endforeach; ?>
            <?php else: ?>
                <h2>No School found</h2>
            <?php endif; ?>


        </div>
    </div>
    
<?php $this->view('includes/footer') ?>