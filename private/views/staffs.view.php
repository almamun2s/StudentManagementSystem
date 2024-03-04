<?php $this->view('includes/header') ?>
    <div class="container-fluid p-4 shadow">
        <?php $this->view('includes/b_crumb') ?>

        <div>
            <a href="signup" class="btn btn-primary" >Add User</a>
        </div>
        <div class="card-group justify-content-center">

            <?php if($users) : ?>
                <?php foreach ($users as $user ): ?>
                    <div class="card m-2" style="max-width: 14rem;min-width: 14rem;">
                        <img src="assets/img/user_female.jpg" class="" style="" >
                        <div class="card-body">
                            <h5 class="card-title"><?= $user->fname.' '.$user->lname ?></h5>
                            <p class="card-text text-capitalize">Role: <?= $user->role ?></p>
                            <a href="profile/visit/<?= $user->user_id ?>" class="btn btn-primary">Profile</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <h2>No Staff found</h2>
            <?php endif; ?>


        </div>
    </div>
    
<?php $this->view('includes/footer') ?>