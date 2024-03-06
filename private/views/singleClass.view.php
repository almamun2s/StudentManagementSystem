<?php $this->view('includes/header') ?>
<style>
    td{
        text-transform: capitalize;
    }
</style>
    <div class="container-fluid p-4 shadow mx-auto" style="max-width: 1200px;">
        <?php if($class) : ?>
            <?php $this->view('includes/b_crumb') ?>
            <div class="row">
                <h3 class="text-center" ><?= esc($class->class_name) ?></h3>
                <table class="table table-hover table-striped table-bordered" >
                    <tr>
                        <th>Class Name:</th>
                        <td><?= esc($class->class_name) ?></td>
                    </tr>
                    <tr>
                        <th>Created by:</th>
                        <td><?= esc($user->fname).' '.esc($user->lname) ?></td>
                    </tr>
                    <tr>
                        <th>Created at:</th>
                        <td><?= get_date($class->date) ?></td>
                    </tr>
                </table>
            </div>
            <div>
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link <?= get_active_tab('lecturers', $tab) ?>" href="<?= ROOT ?>schools/singleClass/<?= $class->class_id ?>?tab=lecturers">Lecturers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= get_active_tab('students', $tab) ?>" href="<?= ROOT ?>schools/singleClass/<?= $class->class_id ?>?tab=students">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= get_active_tab('tests', $tab) ?>" href="<?= ROOT ?>schools/singleClass/<?= $class->class_id ?>?tab=tests">Tests</a>
                    </li>
                </ul>

                <nav class="navbar navbar-light bg-light">
                    <form class="form-inline">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
                    </form>
                </nav>
            </div>
        <?php else:?>
            <h2 class="text-center" >The class you are looking for was not found</h2>
        <?php endif;?>
    </div>
    
<?php $this->view('includes/footer') ?>