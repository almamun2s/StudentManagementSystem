<?php $this->view('includes/header') ?>
    <div class="container-fluid p-4 shadow">
        <?php $this->view('includes/b_crumb') ?>

        <nav class="navbar navbar-light bg-light">
            <form class="form-inline d-flex">
                <input class="form-control mr-sm-2" type="search" placeholder="Search <?= $mode ?>" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <div>
                <a href="<?= ROOT ?>signup?mode=<?= $mode ?>" class="btn btn-primary text-capitalize" >Add <?= $mode ?></a>
            </div>
        </nav>
        <div class="card-group justify-content-center">

            <?php if($users) : ?>
                <?php foreach ($users as $user ): ?>
                    <div class="card m-2" style="max-width: 14rem;min-width: 14rem;">
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
                        <img src="<?= $profile ?>" class="" style="" >
                        <div class="card-body">
                            <h5 class="card-title"><?= $user->fname.' '.$user->lname ?></h5>
                            <p class="card-text text-capitalize">Role: <?= $user->role ?></p>
                            <a href="<?= ROOT ?>profile/visit/<?= $user->user_id ?>" class="btn btn-primary">Profile</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <h2>No <?= $mode ?> found</h2>
            <?php endif; ?>


        </div>
    </div>
    
<?php $this->view('includes/footer') ?>