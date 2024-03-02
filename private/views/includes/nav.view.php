<nav class="sms-nav" >
    <ul>
        <li><a href="home">Dashboard</a></li>
        <li><a href="#">Users</a></li>
        <li><a href="#">Classes</a></li>
        <li><a href="#" class="active" >Tests</a></li>
        <!-- <li><a href="#">User</a></li> -->
    </ul>
    <ul>
        <?php if (Auth::is_logged_in()): ?>
            <li><a href="profile">Profile</a></li>
            <li><a href="profile/logout">Logout</a></li>
        <?php else:?>
            <li><a href="login">Login</a></li>
            <li><a href="signup">Sign Up</a></li>
        <?php endif;?>
    </ul>
</nav>