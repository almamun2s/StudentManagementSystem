<nav class="sms-nav" >
    <ul>
        <li><a href="<?=ROOT?>home">Dashboard</a></li>
        <li><a href="<?=ROOT?>schools">schools</a></li>
        <li><a href="<?=ROOT?>users">staffs</a></li>
        <li><a href="<?=ROOT?>users/students">students</a></li>
        <li><a href="<?=ROOT?>class">Classes</a></li>
        <li><a href="<?=ROOT?>tests" class="active" >Tests</a></li>
    </ul>
    <ul>
        <?php if (Auth::is_logged_in()): ?>
            <li><a href="<?=ROOT?>profile">Profile<span>(<?= Auth::user()->fname.' '.Auth::user()->lname ?>)</span></a></li>
            <li><a href="<?=ROOT?>profile/logout">Logout</a></li>
        <?php else:?>
            <li><a href="<?=ROOT?>login">Login</a></li>
            <li><a href="<?=ROOT?>signup">Sign Up</a></li>
        <?php endif;?>
    </ul>
</nav>