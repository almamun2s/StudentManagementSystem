<?php 
/**
 * This is class item file for profile page
 */
?><tr class="<?php // $color ?>" >
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
    <?php if(Auth::access('lecturer')):?>
        <td>
            <?php if((Auth::owner($class->user_id)) || Auth::access('reception')) : ?>
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
            <?php endif; ?>
        </td>
    <?php endif; ?>
</tr>
