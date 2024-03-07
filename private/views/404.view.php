<?php 
    /**
     * This is 404 file 
     */
?>
<?php $this->view('includes/header') ?>
    <div class="container-fluid text-center my-4">
        <h1><?= $code ?> Error</h1>
        <h3><?= $error ?></h3>
    </div>
    
<?php $this->view('includes/footer') ?>