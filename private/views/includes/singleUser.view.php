<?php 
/**
 * This is single user view file
 */
    $profile = ROOT.'assets/images/'.$user->profile_pic;
    if (!file_exists($profile)) {
        if ($user->gender == 'male') {
            $profile = ROOT.'assets/img/user_male.jpg';
        }else {
            $profile = ROOT.'assets/img/user_female.jpg';
        }
    }
?>
<img src="<?= $profile ?>" class="" style="" >
<div class="card-body">
    <h5 class="card-title"><?= $user->fname.' '.$user->lname ?></h5>
    <p class="card-text text-capitalize">Role: <?= $user->role ?></p>
    <a href="<?= ROOT ?>profile/<?= $user->user_id ?>" class="btn btn-primary">Profile</a>
    <?php if (in_array('search', $_GET)) : ?>
        <button type="submit" class="btn btn-success float-end sms-user_select_btn" name="user_id" value="<?= $user->user_id ?>" >Select</button>
    <?php endif;?>
</div>