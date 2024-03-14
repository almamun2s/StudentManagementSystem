<?php 
    /**
     * This is single class  file 
     * Single class are shown through this file
     */
?>
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
                        <th>Created by:</th>
                        <td><a class="text-decoration-none" href="<?= ROOT ?>profile/<?= $class->user_id->user_id ?>"><?= esc($user->fname).' '.esc($user->lname) ?></a></td>
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

                <?php 
                    switch ($tab) {
                        case 'lecturers':
                            include view_path('class/tab_lecturers');
                            break;
                        case 'students':
                            include view_path('class/tab_students');
                            break;
                        case 'tests':
                            include view_path('class/tab_tests');
                            break;
                        default:
                            break;
                    }
                ?>
            </div>
        <?php else:?>
            <?php  $this->redirect('errors') ?>
        <?php endif;?>
    </div>
    
<?php $this->view('includes/footer') ?>