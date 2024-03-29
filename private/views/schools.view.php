<?php 
    /**
     * This is school file 
     * All school are shown through this file
     */
?>
<?php $this->view('includes/header') ?>
    <div class="container-fluid p-4 shadow">
        <?php $this->view('includes/b_crumb') ?>

        <div class="card-group justify-content-center">
            <table class="table table-striped table-hover" >
                <tr>
                    <th></th>
                    <th>School</th>
                    <th>Created By</th>
                    <th>Date</th>
                    <th>
                        <span class="btn btn-primary" id="addNewSchool" ><i class="fas fa-plus"></i> Add new School</span>
                    </th>
                </tr>
                <?php if($schools) : ?>
                    <?php foreach ($schools as $school ): ?>
                        <?php $color = $school->school_id == Auth::user()->school_id ? 'bg-primary text-white' : '' ?>
                        <tr class="<?= $color ?>" >
                            <td>
                                <button class="btn btn-info text-white" >
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </td>
                            <td><?= $school->school_name ?></td>
                            <td><?= $school->user_id->fname.' '.$school->user_id->lname ?></td>
                            <td><?= get_date($school->date) ?></td>
                            <td>
                                <button class="btn btn-info text-white sms-edit_school_btn" onclick="showEditPopup('edit_<?= $school->school_id ?>')" ><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger" onclick="showEditPopup('delete_<?= $school->school_id ?>')" ><i class="fas fa-trash"></i></button>
                                <?php if(Auth::user()->role == 'super') : ?>
                                <button class="btn btn-success" onclick="showEditPopup('switch_<?= $school->school_id ?>')" >Switch Here<i class="fas fa-arrow-right"></i></button>
                                <?php  endif; ?>
                                <!-- Edit School Popup  -->
                                <?php
                                    if ( isset($_POST['id']) && ($_POST['id'] == $school->id) && isset($errors['school_name'])) {
                                        # code...
                                        $showEditSchool = 'sms-add_new_school_show';
                                        $editValue      =  get_old_value('school_name');
                                        $errorMessage   = get_error($errors, 'school_name');
                                    }else{
                                        $showEditSchool = '';
                                        $editValue      = $school->school_name;
                                        $errorMessage   = '';
                                    }
                                ?>
                                <div class="sms-edit_school <?= $showEditSchool ?>" id="edit_<?= $school->school_id ?>" >
                                    <div class="sms-school_form border shadow p-4">
                                        <form action="<?= ROOT?>schools/edit" method="post">
                                            <h3 class="text-dark" >Edit School(<?= $school->school_name ?>)</h3>

                                            <input type="hidden" name="id" value="<?= $school->id ?>" >
                                            <input type="text" value="<?= $editValue ?>" name="school_name" class="form-control" autofocus placeholder="School Name" >
                                            <p class="text-danger" ><?= $errorMessage ?></p>

                                            <input type="submit" value="Edit" class="btn btn-primary mt-4 float-end" >

                                            <span class="btn btn-danger mt-4" onclick="hideEditPopup('edit_<?= $school->school_id ?>')" >Cancel</span>
                                        </form>
                                    </div>
                                </div>                                
                                <!-- Delete School Popup  -->
                                <div class="sms-edit_school" id="delete_<?= $school->school_id ?>" >
                                    <div class="sms-school_form border shadow p-4">
                                        <form action="schools/delete" method="post">
                                            <h3 class="text-dark" >Are You really want to delete? <br> <?= $school->school_name ?></h3>

                                            <input type="hidden" name="id" value="<?= $school->id ?>" >
                                            <input type="submit" value="Delete" class="btn btn-danger mt-4 float-end" >

                                            <span class="btn btn-primary mt-4" onclick="hideEditPopup('delete_<?= $school->school_id ?>')" >Cancel</span>
                                        </form>
                                    </div>
                                </div>
                                <?php if(Auth::user()->role == 'super') : ?>
                                    <!-- Switch School Popup  -->
                                    <div class="sms-edit_school" id="switch_<?= $school->school_id ?>" >
                                        <div class="sms-school_form border shadow p-4">
                                            <form action="schools/switch" method="post">
                                                <h3 class="text-dark" >Do you want to switch here? <br> <?= $school->school_name ?></h3>

                                                <input type="hidden" name="school_id" value="<?= $school->school_id ?>" >
                                                <input type="submit" value="Switch" class="btn btn-danger mt-4 float-end" >

                                                <span class="btn btn-primary mt-4" onclick="hideEditPopup('switch_<?= $school->school_id ?>')" >Cancel</span>
                                            </form>
                                        </div>
                                    </div>
                                <?php  endif; ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                <?php else: ?>
                    <h2>No School found</h2>
                <?php endif; ?>
            </table>


        </div>
    </div>
    
    <!-- Add New School Popup  -->
    <?php
        if ( !isset($_POST['id']) && isset($errors['school_name'])) {
            $showAddSchool  = 'sms-add_new_school_show';
            $addSchoolErr   = get_error($errors , 'school_name');
            $addSchoolOld   = get_old_value('school_name');
        }else{
            $showAddSchool  = '';
            $addSchoolErr   = '';
            $addSchoolOld   = '';
        }
    ?>
    <div class="sms-add_new_school <?= $showAddSchool ?>">
        <div class="sms-school_form border shadow p-4">
            <form action="<?= ROOT ?>schools/add" method="post">
                <h3>Add new School</h3>
                <input type="text" name="school_name" class="form-control" autofocus placeholder="School Name" value="<?= $addSchoolOld ?>" >
                <p class="text-danger" ><?= $addSchoolErr ?></p>

                <input type="submit" value="Create" class="btn btn-primary mt-4 float-end" >

                <span class="btn btn-danger mt-4" id="addNewSchoolCancel" >Cancel</span>
            </form>
        </div>
    </div>
<?php $this->view('includes/footer') ?>