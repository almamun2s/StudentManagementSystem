<?php $this->view('includes/header') ?>
    <div class="container-fluid">
        <div class="p-4 mt-4 mx-auto rounded shadow" style="width:100%;max-width: 325px;">
            <h2 class="text-center" >Add User</h2>
            <form action="signup" method="post">
                <input name="fname" value="<?= get_old_value('fname') ?>" placeholder="First Name" type="text" class="my-4 form-control" autofocus autocomplete="off">
                <input name="lname" value="<?= get_old_value('lname') ?>" placeholder="Last Name" type="text" class="my-4 form-control" autocomplete="off">
                <input name="email" value="<?= get_old_value('email') ?>" placeholder="Email" type="email" class="my-4 form-control" autocomplete="off">

                <select name="gender" class="my-4 form-control" >
                    <option <?= get_selected('gender', '') ?> value="">--Select a Gender--</option>
                    <option <?= get_selected('gender', 'male') ?> value="male">Male</option>
                    <option <?= get_selected('gender', 'female') ?> value="female">Female</option>
                </select>

                <select name="rank" class="my-4 form-control" >
                    <option <?= get_selected('rank', '') ?> value="">--Select a Rank--</option>
                    <option <?= get_selected('rank', 'student') ?> value="student">Student</option>
                    <option <?= get_selected('rank', 'reception') ?> value="reception">Reception</option>
                    <option <?= get_selected('rank', 'lecturer') ?> value="lecturer">Lecturer</option>
                    <option <?= get_selected('rank', 'admin') ?> value="admin">Admin</option>
                    <option <?= get_selected('rank', 'super') ?> value="super">Super Admin</option>
                </select>

                <input name="password" placeholder="Password" type="text" class="my-4 form-control" autocomplete="off">
                <input name="password2" placeholder="Password" type="text" class="my-4 form-control" autocomplete="off">

                <button type="submit" class="btn btn-primary float-end">Add User</button>
                <button type="button" class="btn btn-danger text-white">Cancel</button>             
            </form>
        </div>
    </div>
    
<?php $this->view('includes/footer') ?> 