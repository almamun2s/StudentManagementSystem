<?php 
    /**
     * This is profile Edit 
     */
?>
<?php $this->view('includes/header') ?>
<style>
    td{
        text-transform: capitalize;
    }
</style>
    <div class="container-fluid p-4 shadow mx-auto" style="max-width: 1200px;">
        <?php if($user) : ?>
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <?php 
                        $profile = ROOT.'assets/images/'.$user->profile_pic;
                        if (!file_exists($profile)) {
                            if ($user->gender == 'male') {
                                $profile = ROOT.'assets/img/user_male.jpg';
                            }else {
                                $profile = ROOT.'assets/img/user_female.jpg';
                            }
                        }
                    ?>
                    <img src="<?= $profile ?>" class="border border-primary d-block mx-auto rounded-circle" style="width:150px" >
                    <div class="text-center mt-4" >
                        <a class="btn btn-warning" href="#">Upload image</a>
                        <span class="btn btn-danger" >Delete Profile</span>
                    </div>
                </div>
                <div class="col-sm-8 col-md-9 bg-light p-2">
                    <form action="" method="post">
                        <input name="fname" value="<?= get_old_value('fname', $user) ?>" placeholder="First Name" type="text" class="my-4 form-control" autofocus autocomplete="off">
                        <p class="text-danger" ><?= get_error($errors,  'fname') ?></p>
                        
                        <input name="lname" value="<?= get_old_value('lname', $user ) ?>" placeholder="Last Name" type="text" class="my-4 form-control" autocomplete="off">
                        <p class="text-danger" ><?= get_error($errors,  'lname') ?></p>
                        
                        <input name="email" value="<?= get_old_value('email', $user ) ?>" placeholder="Email" type="email" class="my-4 form-control" autocomplete="off">
                        <p class="text-danger" ><?= get_error($errors,  'email') ?></p>

                        <select name="gender" class="my-4 form-control" >
                            <option <?= get_selected('gender', '', $user) ?> value="">--Select a Gender--</option>
                            <option <?= get_selected('gender', 'male', $user) ?> value="male">Male</option>
                            <option <?= get_selected('gender', 'female', $user) ?> value="female">Female</option>
                        </select>
                        <p class="text-danger" ><?= get_error($errors,  'gender') ?></p>
                        <?php if((Auth::user()->role == 'student') || (Auth::user()->role == 'lecturer') ) : ?>
                            <input type="hidden" name="role" value="<?= Auth::user()->role ?>" >
                        <?php elseif($user->role == 'student' ): ?>
                            <input type="hidden" name="role" value="<?= $user->role ?>" >
                        <?php else: ?>
                            <select name="role" class="my-4 form-control" >
                                <option <?= get_selected('role', '', $user ) ?> value="">--Select a Rank--</option>
                                <?php if( Auth::access('reception')): ?>
                                    <option <?= get_selected('role', 'lecturer', $user ) ?> value="lecturer">Lecturer</option>
                                    <option <?= get_selected('role', 'reception', $user ) ?> value="reception">Reception</option>
                                <?php endif;?>

                                <?php if( Auth::access('admin')): ?>
                                    <option <?= get_selected('role', 'admin', $user ) ?> value="admin">Admin</option>
                                <?php endif;?>

                                <?php if( Auth::access('super')): ?>
                                    <option <?= get_selected('role', 'super', $user ) ?> value="super">Super Admin</option>
                                <?php endif;?>
                            </select>
                        <?php endif; ?>

                        <p class="text-danger" ><?= get_error($errors,  'role') ?></p>
                        
                        <p class="text-success" >Keep password field empty for not changing password</p>
                        <input name="password" placeholder="Password" type="text" class="my-4 form-control" autocomplete="off">
                        <p class="text-danger" ><?= get_error($errors,  'password') ?></p>

                        <input name="password2" placeholder="Retype Password" type="text" class="my-4 form-control" autocomplete="off">
                        
                        <button type="submit" class="btn btn-primary float-end">Update Data</button>
                        <a href="<?= ROOT ?>profile/<?= $user->user_id ?>" type="button" class="btn btn-danger text-white">Cancel</a>             
                    </form>
                </div>
            </div>
        <?php else:?>
            <?php $this->redirect('errors') ?>
        <?php endif;?>
    </div>
    
<?php $this->view('includes/footer') ?>