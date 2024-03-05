<?php $this->view('includes/header') ?>
    <div class="container-fluid p-4 shadow">
        <?php $this->view('includes/b_crumb') ?>

        <div class="card-group justify-content-center">
            <table class="table table-striped table-hover" >
                <tr>
                    <th></th>
                    <th>Class</th>
                    <th>Created By</th>
                    <th>Date</th>
                    <th>
                        <span class="btn btn-primary" id="addNewSchool" ><i class="fas fa-plus"></i> Add new Class</span>
                    </th>
                </tr>
                <?php if($classes) : ?>
                    <?php foreach ($classes as $class ): ?>
                        <?php // $color = $class->class_id == Auth::user()->class_id ? 'bg-primary text-white' : '' ?>
                        <tr class="<?php // $color ?>" >
                            <td>
                                <button class="btn btn-info text-white" >
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </td>
                            <td><?= $class->class_name ?></td>
                            <td><?= $class->user_id->fname.' '.$class->user_id->lname ?></td>
                            <td><?= get_date($class->date) ?></td>
                            <td>
                                <button class="btn btn-info text-white sms-edit_school_btn" onclick="showEditPopup('edit_<?= $class->class_id ?>')" ><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger" onclick="showEditPopup('delete_<?= $class->class_id ?>')" ><i class="fas fa-trash"></i></button>
                                <?php if(Auth::user()->role == 'super') : ?>
                                <!-- <button class="btn btn-success" onclick="showEditPopup('switch_<?= $class->class_id ?>')" >Switch Here<i class="fas fa-arrow-right"></i></button> -->
                                <?php  endif; ?>
                                <!-- Edit class Popup  -->
                                <div class="sms-edit_school" id="edit_<?= $class->class_id ?>" >
                                    <div class="sms-school_form border shadow p-4">
                                        <form action="schools/edit" method="post">
                                            <h3 class="text-dark" >Edit class(<?= $class->class_name ?>)</h3>

                                            <input type="hidden" name="id" value="<?= $class->id ?>" >
                                            <input type="text" value="<?= $class->class_name ?>" name="class_name" class="form-control" autofocus placeholder="class Name" >
                                            <input type="submit" value="Edit" class="btn btn-primary mt-4 float-end" >

                                            <span class="btn btn-danger mt-4" onclick="hideEditPopup('edit_<?= $class->class_id ?>')" >Cancel</span>
                                        </form>
                                    </div>
                                </div>                                
                                <!-- Delete class Popup  -->
                                <div class="sms-edit_school" id="delete_<?= $class->class_id ?>" >
                                    <div class="sms-school_form border shadow p-4">
                                        <form action="schools/delete" method="post">
                                            <h3 class="text-dark" >Are You really want to delete? <br> <?= $class->class_name ?></h3>

                                            <input type="hidden" name="id" value="<?= $class->id ?>" >
                                            <input type="submit" value="Delete" class="btn btn-danger mt-4 float-end" >

                                            <span class="btn btn-primary mt-4" onclick="hideEditPopup('delete_<?= $class->class_id ?>')" >Cancel</span>
                                        </form>
                                    </div>
                                </div>
                                <!-- <?php if(Auth::user()->role == 'super') : ?> -->
                                    <!-- Switch class Popup  -->
                                    <!-- <div class="sms-edit_school" id="switch_<?= $class->class_id ?>" >
                                        <div class="sms-school_form border shadow p-4">
                                            <form action="schools/switch" method="post">
                                                <h3 class="text-dark" >Do you want to switch here? <br> <?= $class->class_name ?></h3>

                                                <input type="hidden" name="class_id" value="<?= $class->class_id ?>" >
                                                <input type="submit" value="Switch" class="btn btn-danger mt-4 float-end" >

                                                <span class="btn btn-primary mt-4" onclick="hideEditPopup('switch_<?= $class->class_id ?>')" >Cancel</span>
                                            </form>
                                        </div>
                                    </div> -->
                                <!-- <?php  endif; ?> -->
                            </td>
                        </tr>

                    <?php endforeach; ?>
                    <?php else: ?>
                        <h2>No class found</h2>
                    <?php endif; ?>
                </table>


        </div>
    </div>
    
    <!-- Add New Class Popup  -->
    <div class="sms-add_new_school">
        <div class="sms-school_form border shadow p-4">
            <form action="<?= ROOT ?>schools/classAdd" method="post">
                <h3>Add new class</h3>
                <input type="text" name="class_name" class="form-control" autofocus placeholder="class Name" >
                <input type="submit" value="Create" class="btn btn-primary mt-4 float-end" >

                <span class="btn btn-danger mt-4" id="addNewSchoolCancel" >Cancel</span>
            </form>
        </div>
    </div>
<?php $this->view('includes/footer') ?>