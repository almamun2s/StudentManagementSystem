<?php 
    /**
     * This is Staff file 
     */
?>
<?php $this->view('includes/header') ?>
    <div class="container-fluid p-4 shadow">
        <?php $this->view('includes/b_crumb') ?>

        <nav class="navbar navbar-light bg-light">
            <form class="form-inline d-flex">
                <input name="find" value="<?= isset($_GET['find']) ? $_GET['find'] : '' ?>" class="form-control mr-sm-2" type="search" placeholder="Search <?= $mode ?>" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <div>
                <?php if (Auth::access('reception')) :?>
                <a href="<?= ROOT ?>signup?mode=<?= $mode ?>" class="btn btn-primary text-capitalize" >Add <?= $mode ?></a>
                <?php endif; ?>
            </div>
        </nav>
        <div class="card-group justify-content-center">

            <?php if($users) : ?>
                <?php foreach ($users as $user ): ?>
                    <div class="card m-2" style="max-width: 14rem;min-width: 14rem;">
                    <?php 
                        include view_path('includes/singleUser');
                    ?>                    
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <h2>No <?= $mode ?> found</h2>
            <?php endif; ?>

            
        </div>
        <?php 
            if ($pagination) {
                echo $pagination->display();
            }
        ?>
    </div>
    
<?php $this->view('includes/footer') ?>