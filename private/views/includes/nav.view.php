<?php 
    /**
     * This is header nav file 
     */
?>
<nav class="sms-nav" >
    <ul>
        <li><a class="<?= get_active_item('home') ?>" href="<?=ROOT?>home">Dashboard</a></li>
        <li><a class="<?= get_active_item('schools') ?>" href="<?=ROOT?>schools">schools</a></li>
        <li><a class="<?= get_active_item('users') ?>" href="<?=ROOT?>users">staffs</a></li>
        <li><a class="<?= get_active_item('users/students') ?>" href="<?=ROOT?>users/students">students</a></li>
        <li><a class="<?= get_active_item('schools/class') ?>" href="<?=ROOT?>schools/class">Classes</a></li>
        <li><a class="<?= get_active_item('tests') ?>" href="<?=ROOT?>tests" class="active" >Tests</a></li>
    </ul>
    <ul>
        <?php if (Auth::is_logged_in()): ?>
            <li><a class="<?= get_active_item('profile') ?>" href="<?=ROOT?>profile">Profile<span>(<?= Auth::user()->fname.' '.Auth::user()->lname ?>)</span></a></li>
            <li><a href="<?=ROOT?>profile/logout">Logout</a></li>
        <?php else:?>
            <li><a href="<?=ROOT?>login">Login</a></li>
            <li><a href="<?=ROOT?>signup">Sign Up</a></li>
        <?php endif;?>
    </ul>
</nav>