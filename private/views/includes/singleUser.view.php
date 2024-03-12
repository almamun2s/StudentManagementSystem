<?php 
/**
 * This is single user view file
 */
?>
<img src="<?= get_image($user->profile_pic, $user) ?>" class="" style="" >
<div class="card-body">
    <h5 class="card-title"><?= $user->fname.' '.$user->lname ?></h5>
    <p class="card-text text-capitalize">Role: <?= $user->role ?></p>
    <a href="<?= ROOT ?>profile/<?= $user->user_id ?>" class="btn btn-primary">Profile</a>
    <?php if ((in_array('search', $_GET)) && (Auth::access('reception'))) : ?>
        <button type="submit" class="btn btn-success float-end sms-user_select_btn" name="user_id" value="<?= $user->user_id ?>" >Select</button>
    <?php endif;?>
</div>