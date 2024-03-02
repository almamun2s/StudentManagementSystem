<?php $this->view('includes/header') ?>
    <div class="container-fluid">
        <div class="p-4 mt-4 mx-auto rounded shadow" style="width:100%;max-width: 325px;">
            <h2 class="text-center" >Login</h2>
            <form action="login" method="post">

                <input name="email" value="<?= get_old_value('email') ?>" placeholder="Email" type="text" class="my-4 form-control" autofocus autocomplete="off">
                <p class="text-danger" ><?= get_error($errors,  'email') ?></p>

                <input name="password" placeholder="Password" type="password" class="my-4 form-control" autocomplete="off">
                <button class="btn btn-primary">Login</button>

            </form>
        </div>
    </div>
    
<?php $this->view('includes/footer') ?>