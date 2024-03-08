<table class="table table-hover table-striped" >
    <tr>
        <th>Class Name</th>
        <th>Created By</th>
        <th>Created At</th>
        <?php if((Auth::access('lecturer')) && (Auth::user()->user_id == $user->user_id )):?>
            <th>
                <span class="btn btn-primary" id="addNewSchool" ><i class="fas fa-plus"></i> Add new Class</span>
            </th>
        <?php elseif((Auth::access('lecturer')) ) :?>
            <th></th>
        <?php endif; ?>
    </tr>
    <?php if($classes) : ?>
        <?php foreach($classes as $class ): ?>
            <?php include view_path('class/class_item'); ?>

        <?php endforeach;?>
    <?php else:?>
        <h4 class="text-center" >Did not joined any class yet.</h4>
    <?php endif;?>
</table>

<?php if((Auth::access('lecturer')) && (Auth::user()->user_id == $user->user_id )):?>
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