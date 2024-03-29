<?php 
    /**
     * This is header nav file 
     */
?>
<nav class="sms-nav" >
    <ul>
        <?php if (Auth::is_logged_in()): ?>
            <li><a class="<?= get_active_item('home') ?>" href="<?=ROOT?>home">Dashboard</a></li>
            <?php if(Auth::access('admin')): ?>
                <li><a class="<?= get_active_item('schools') ?>" href="<?=ROOT?>schools">schools</a></li>
            <?php endif; ?>
                        
            <?php if(Auth::access('lecturer')): ?>
                <li><a class="<?= get_active_item('users') ?>" href="<?=ROOT?>users">staffs</a></li>
                <li><a class="<?= get_active_item('users/students') ?>" href="<?=ROOT?>users/students">students</a></li>
            <?php endif; ?>

            <li><a class="<?= get_active_item('schools/class') ?>" href="<?=ROOT?>schools/class">Classes</a></li>
        <?php endif;?>
    </ul>
    <ul>
        <?php if (Auth::is_logged_in()): ?>
            <li>
                <a class="<?= get_active_item('profile') ?>" href="<?=ROOT?>profile">Profile<span>(<?= Auth::user()->fname.' '.Auth::user()->lname ?>)</span></a>
            </li>
            <li><a href="<?=ROOT?>profile/logout">Logout</a></li>
        <?php else:?>
            <li><a class="<?= get_active_item('login') ?>" href="<?=ROOT?>login">Login</a></li>
            <li><a class="<?= get_active_item('signup') ?>" href="<?=ROOT?>signup">Sign Up</a></li>
        <?php endif;?>
    </ul>
</nav>