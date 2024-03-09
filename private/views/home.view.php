<?php $this->view('includes/header') ?>
    <div class="container-fluid">
        <div class="row justify-content-center">

            <?php if(Auth::access('admin')): ?>
                <div class="col-md-3 shadow rounded border p-0 m-4">
                    <a href="<?=ROOT?>schools" class="text-dark text-decoration-none" >
                        <div class="card-header text-uppercase">School</div>
                        <h1 class="text-center" style="font-size: 5rem; color: green;" ><i class="fas fa-graduation-cap"></i></h1>
                        <div class="card-footer">View all schools</div>
                    </a>
                </div>
            <?php endif; ?>

            <?php if(Auth::access('lecturer')): ?>
            <div class="col-md-3 shadow rounded border p-0 m-4">
                <a href="<?=ROOT?>users" class="text-dark text-decoration-none" >
                    <div class="card-header text-uppercase">Staff</div>
                    <h1 class="text-center" style="font-size: 5rem; color: green;" ><i class="fas fa-chalkboard-teacher"></i></h1>
                    <div class="card-footer">View all staff</div>
                </a>    
            </div>
            <div class="col-md-3 shadow rounded border p-0 m-4">
                <a href="<?=ROOT?>users/students" class="text-dark text-decoration-none" >
                    <div class="card-header text-uppercase">Students</div>
                    <h1 class="text-center" style="font-size: 5rem; color: green;" ><i class="fas fa-user-graduate"></i></h1>
                    <div class="card-footer">View all Students</div>
                </a>    
            </div>
            <?php endif; ?>

            <div class="col-md-3 shadow rounded border p-0 m-4">
                <a href="<?=ROOT?>schools/class" class="text-dark text-decoration-none" >
                    <div class="card-header text-uppercase">classes</div>
                    <h1 class="text-center" style="font-size: 5rem; color: green;" ><i class="fas fa-university"></i></h1>
                    <div class="card-footer">View all classes</div>
                </a>    
            </div>
            <div class="col-md-3 shadow rounded border p-0 m-4">
                <a href="<?=ROOT?>tests" class="text-dark text-decoration-none" >
                    <div class="card-header text-uppercase">tests</div>
                    <h1 class="text-center" style="font-size: 5rem; color: green;" ><i class="fas fa-file-signature"></i></h1>
                    <div class="card-footer">View all tests</div>
                </a>    
            </div>

            <?php if(Auth::access('admin')): ?>
                <div class="col-md-3 shadow rounded border p-0 m-4">
                    <a href="<?=ROOT?>statistics" class="text-dark text-decoration-none" >
                        <div class="card-header text-uppercase">statistics</div>
                        <h1 class="text-center" style="font-size: 5rem; color: green;" ><i class="fas fa-chart-pie"></i></h1>
                        <div class="card-footer">View all statistics</div>
                    </a>    
                </div>
                <div class="col-md-3 shadow rounded border p-0 m-4">
                    <a href="<?=ROOT?>settings" class="text-dark text-decoration-none" >
                        <div class="card-header text-uppercase">settings</div>
                        <h1 class="text-center" style="font-size: 5rem; color: green;" ><i class="fas fa-cogs"></i></h1>
                        <div class="card-footer">View all settings</div>
                    </a>    
                </div>
            <?php endif; ?>
            
            <div class="col-md-3 shadow rounded border p-0 m-4">
                <a href="<?=ROOT?>profile" class="text-dark text-decoration-none" >
                    <div class="card-header text-uppercase">profile</div>
                    <h1 class="text-center" style="font-size: 5rem; color: green;" ><i class="fas fa-id-card"></i></h1>
                    <div class="card-footer">View profile</div>
                </a>    
            </div>
            <div class="col-md-3 shadow rounded border p-0 m-4">
                <a href="<?=ROOT?>profile/logout" class="text-dark text-decoration-none" >
                    <div class="card-header text-uppercase">Log Out</div>
                    <h1 class="text-center" style="font-size: 5rem; color: green;" ><i class="fas fa-sign-out"></i></h1>
                    <div class="card-footer">Click to log out</div>
                </a>    
            </div>

        </div>
    </div>
    
<?php $this->view('includes/footer') ?>