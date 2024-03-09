<?php 
    /**
     * This is main header file 
     */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php if(Auth::is_logged_in()) : ?>
            <?= Auth::user()->role. ' - ' . Auth::user()->fname.' '. Auth::user()->lname ?>
            || 
        <?php endif;?>
        Student Management System
    </title>
    <link rel="stylesheet" href="<?=ROOT?>assets/bootstrap.min.css">
    <link rel="stylesheet" href="<?=ROOT?>assets/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT?>assets/style.css">
</head>
<body style="min-width: 350px;">
<div style="max-width: 1200px; width:90%; margin: auto;"  >

<?php $this->view('includes/nav') ?>
