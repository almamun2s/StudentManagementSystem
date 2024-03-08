<?php 
    /**
     * This is class file 
     * All class are shown through this file
     */

    $this->view('includes/header') 
?>
    <div class="container-fluid p-4 shadow">
        <?php $this->view('includes/b_crumb') ?>

        <div class="card-group justify-content-center">
            <table class="table table-striped table-hover" >
                <tr>
                    <th>Class</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <?php if(Auth::access('reception')):?>
                        <th>
                            <span class="btn btn-primary" id="addNewSchool" ><i class="fas fa-plus"></i> Add new Class</span>
                        </th>
                    <?php endif; ?>
                </tr>
                <?php if($classes) : ?>
                    <?php foreach ($classes as $class ): ?>
                        <?php // $color = $class->class_id == Auth::user()->class_id ? 'bg-primary text-white' : '' ?>
                        <tr class="<?php // $color ?>" >
                            <td>
                                <a href="<?= ROOT ?>schools/singleClass/<?= $class->class_id ?>" class="text-decoration-none" >
                                    <?= $class->class_name ?>
                                </a>
                            </td>
                            <td>
                                <a href="<?= ROOT ?>profile/<?= $class->user_id->user_id ?>" class="text-decoration-none" >
                                    <?= $class->user_id->fname.' '.$class->user_id->lname ?>
                                </a>
                            </td>
                            <td><?= get_date($class->date) ?></td>
                            <?php if(Auth::access('reception')):?>
                                <td>
                                    <button class="btn btn-info text-white sms-edit_school_btn" onclick="showEditPopup('edit_<?= $class->class_id ?>')" ><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger" onclick="showEditPopup('delete_<?= $class->class_id ?>')" ><i class="fas fa-trash"></i></button>
                                    <!-- Edit class Popup  -->
                                    <?php
                                        if ( isset($_POST['id']) && ($_POST['id'] == $class->id) && isset($errors['class_name'])) {
                                            # code...
                                            $showEditSchool = 'sms-add_new_school_show';
                                            $editValue      =  get_old_value('class_name');
                                            $errorMessage   = get_error($errors, 'class_name');
                                        }else{
                                            $showEditSchool = '';
                                            $editValue      = $class->class_name;
                                            $errorMessage   = '';
                                        }
                                    ?>
                                    <div class="sms-edit_school <?= $showEditSchool ?>" id="edit_<?= $class->class_id ?>" >
                                        <div class="sms-school_form border shadow p-4">
                                            <form action="<?= ROOT ?>schools/classEdit" method="post">
                                                <h3 class="text-dark" >Edit class(<?= $class->class_name ?>)</h3>

                                                <input type="hidden" name="id" value="<?= $class->id ?>" >
                                                <input type="text" value="<?= $editValue ?>" name="class_name" class="form-control" autofocus placeholder="class Name" >
                                                <p class="text-danger" ><?= $errorMessage ?></p>

                                                <input type="submit" value="Edit" class="btn btn-primary mt-4 float-end" >

                                                <span class="btn btn-danger mt-4" onclick="hideEditPopup('edit_<?= $class->class_id ?>')" >Cancel</span>
                                            </form>
                                        </div>
                                    </div>                                
                                    <!-- Delete class Popup  -->
                                    <div class="sms-edit_school" id="delete_<?= $class->class_id ?>" >
                                        <div class="sms-school_form border shadow p-4">
                                            <form action="<?= ROOT ?>schools/classDelete" method="post">
                                                <h3 class="text-dark" >Are You really want to delete? <br> <?= $class->class_name ?></h3>

                                                <input type="hidden" name="id" value="<?= $class->id ?>" >
                                                <input type="submit" value="Delete" class="btn btn-danger mt-4 float-end" >

                                                <span class="btn btn-primary mt-4" onclick="hideEditPopup('delete_<?= $class->class_id ?>')" >Cancel</span>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>

                    <?php endforeach; ?>
                    <?php else: ?>
                        <h2>No class found</h2>
                    <?php endif; ?>
                </table>


        </div>
    </div>
    
    <?php if(Auth::access('reception')):?>
        <!-- Add New Class Popup  -->
        <?php
            if ( !isset($_POST['id']) && isset($errors['class_name'])) {
                $showAddSchool  = 'sms-add_new_school_show';
                $addSchoolErr   = get_error($errors , 'class_name');
                $addSchoolOld   = get_old_value('class_name');
            }else{
                $showAddSchool  = '';
                $addSchoolErr   = '';
                $addSchoolOld   = '';
            }
        ?>
        <div class="sms-add_new_school <?= $showAddSchool ?>">
            <div class="sms-school_form border shadow p-4">
                <form action="<?= ROOT ?>schools/classAdd" method="post">
                    <h3>Add new class</h3>
                    <input type="text" name="class_name" class="form-control" autofocus placeholder="class Name" value="<?= $addSchoolOld ?>">
                    <p class="text-danger" ><?= $addSchoolErr ?></p>

                    <input type="submit" value="Create" class="btn btn-primary mt-4 float-end" >

                    <span class="btn btn-danger mt-4" id="addNewSchoolCancel" >Cancel</span>
                </form>
            </div>
        </div>
    <?php endif; ?>
<?php $this->view('includes/footer') ?>