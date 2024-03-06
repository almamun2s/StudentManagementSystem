<?php 
    /**
     * This is signup file 
     */
?>
<?php $this->view('includes/header') ?>
    <div class="container-fluid">
        <div class="p-4 mt-4 mx-auto rounded shadow" style="width:100%;max-width: 325px;">
        <?php $mode = isset($_GET['mode']) ? $_GET['mode'] : 'staff'; ?>
            <h2 class="text-center text-capitalize" >Add <?= $mode ?></h2>
            <form action="signup" method="post">
                <input name="fname" value="<?= get_old_value('fname') ?>" placeholder="First Name" type="text" class="my-4 form-control" autofocus autocomplete="off">
                <p class="text-danger" ><?= get_error($errors,  'fname') ?></p>
                
                <input name="lname" value="<?= get_old_value('lname') ?>" placeholder="Last Name" type="text" class="my-4 form-control" autocomplete="off">
                <p class="text-danger" ><?= get_error($errors,  'lname') ?></p>
                
                <input name="email" value="<?= get_old_value('email') ?>" placeholder="Email" type="email" class="my-4 form-control" autocomplete="off">
                <p class="text-danger" ><?= get_error($errors,  'email') ?></p>

                <select name="gender" class="my-4 form-control" >
                    <option <?= get_selected('gender', '') ?> value="">--Select a Gender--</option>
                    <option <?= get_selected('gender', 'male') ?> value="male">Male</option>
                    <option <?= get_selected('gender', 'female') ?> value="female">Female</option>
                </select>
                <p class="text-danger" ><?= get_error($errors,  'gender') ?></p>
                <?php if($mode == 'student') : ?>
                    <input type="hidden" name="role" value="<?= $mode ?>">
                <?php else: ?>
                    <select name="role" class="my-4 form-control" >
                        <option <?= get_selected('role', '') ?> value="">--Select a Rank--</option>
                        <option <?= get_selected('role', 'reception') ?> value="reception">Reception</option>
                        <option <?= get_selected('role', 'lecturer') ?> value="lecturer">Lecturer</option>
                        <option <?= get_selected('role', 'admin') ?> value="admin">Admin</option>
                        <?php if(Auth::user()->role == 'super'): ?>
                            <option <?= get_selected('role', 'super') ?> value="super">Super Admin</option>
                        <?php endif;?>
                    </select>                        
                <?php endif; ?>

                <p class="text-danger" ><?= get_error($errors,  'role') ?></p>
                
                <input name="password" placeholder="Password" type="text" class="my-4 form-control" autocomplete="off">
                <p class="text-danger" ><?= get_error($errors,  'password') ?></p>

                <input name="password2" placeholder="Password" type="text" class="my-4 form-control" autocomplete="off">
                
                <input type="hidden" name="mode" value="<?= $mode ?>" >
                <button type="submit" class="btn btn-primary float-end">Add User</button>
                <button type="button" class="btn btn-danger text-white">Cancel</button>             
            </form>
        </div>
    </div>
    
<?php $this->view('includes/footer') ?> 