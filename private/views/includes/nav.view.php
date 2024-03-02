<nav class="sms-nav" >
    <ul>
        <li><a href="home">Dashboard</a></li>
        <li><a href="schools">schools</a></li>
        <li><a href="users">staffs</a></li>
        <li><a href="students">students</a></li>
        <li><a href="class">Classes</a></li>
        <li><a href="tests" class="active" >Tests</a></li>
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