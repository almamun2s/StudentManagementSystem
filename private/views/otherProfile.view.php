<?php $this->view('includes/header') ?>
<style>
    td{
        text-transform: capitalize;
    }
</style>
    <div class="container-fluid p-4 shadow mx-auto" style="max-width: 1200px;">
        <?php $this->view('includes/b_crumb') ?>
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <img src="<?=ROOT?>assets/img/user_female.jpg" class="border border-primary d-block mx-auto rounded-circle" style="width:150px" >
            </div>
            <div class="col-sm-8 col-md-9 bg-light p-2">
                <table class="table table-hover table-striped table-bordered" >
                    <tr>
                        <th>First Name:</th>
                        <td><?= $user->fname ?></td>
                    </tr>
                    <tr>
                        <th>Last Name:</th>
                        <td><?= $user->lname ?></td>
                    </tr>
                    <tr>
                        <th>Gender:</th>
                        <td><?= $user->gender ?></td>
                    </tr>
                    <tr>
                        <th>School:</th>
                        <td><?= $school->school_name ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- <div>
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
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </nav>
        </div> -->
    </div>
    
<?php $this->view('includes/footer') ?>