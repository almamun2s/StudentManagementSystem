<?php $this->view('includes/header') ?>
<style>
    td{
        text-transform: capitalize;
    }
</style>
    <div class="container-fluid p-4 shadow mx-auto" style="max-width: 1200px;">
        <?php if($user) : ?>
            <?php $this->view('includes/b_crumb') ?>
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
                    <h3 class="text-center" ><?= esc($user->fname).' '.esc($user->lname) ?></h3>
                </div>
                <div class="col-sm-8 col-md-9 bg-light p-2">
                    <table class="table table-hover table-striped table-bordered" >
                        <tr>
                            <th>First Name:</th>
                            <td><?= esc($user->fname) ?></td>
                        </tr>
                        <tr>
                            <th>Last Name:</th>
                            <td><?= esc($user->lname) ?></td>
                        </tr>
                        <tr>
                            <th>Gender:</th>
                            <td><?= esc($user->gender) ?></td>
                        </tr>
                        <tr>
                            <th>School:</th>
                            <td><?= esc($school->school_name) ?></td>
                        </tr>
                        <tr>
                            <th>Position:</th>
                            <td><?= esc($user->role) ?></td>
                        </tr>
                        <tr>
                            <th>Created at:</th>
                            <td><?= get_date($user->date) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php if(Auth::user()->user_id == $user->user_id ): ?>
                <div>
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Basic Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Classes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tests</a>
                        </li>
                    </ul>

                    <nav class="navbar navbar-light bg-light">
                        <form class="form-inline">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
                        </form>
                    </nav>
                </div>
            <?php endif; ?>
        <?php else:?>
            <h2 class="text-center" >The user you are looking for was not found</h2>
        <?php endif;?>
    </div>
    
<?php $this->view('includes/footer') ?>