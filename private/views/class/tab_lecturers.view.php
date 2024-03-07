<?php 
    /**
     * This is add lecturer file for class 
     */
?>
<nav class="navbar navbar-light bg-light">
    <form class="form-inline d-flex">
        <input class="form-control mr-sm-2" type="search" placeholder="Search Lecturers" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <span class="btn btn-primary" id="addNewSchool" >Add Lecturer</span>
</nav>


<div class="sms-add_new_school " style="align-items: flex-start;" >
    <div class="sms-school_form border shadow p-4" style="width: 50%;" >
        <h3 class="text-center" >Add Lecturer</h3>
        <input type="text" class="form-control" autofocus placeholder="Type Lecturer Name to add" id="sms-search_class_lecturers" >

        <span class="btn btn-danger mt-4" id="addNewSchoolCancel" >Cancel</span>
        <h3 id="sms-loading" class="text-center d-none" >Loading...</h3>
        <form action="<?= ROOT ?>classOperate/selectLecturer" method="post">
            <input type="hidden" name="class_id" value="<?= $class->class_id ?>" >
            <div class="card-group justify-content-center" id="sms-search_class_lecturers_response" ></div>
        </form>
    </div>
</div>



<form action="<?= ROOT ?>classOperate/removeLecturer" method="post" id="sms-show_lecturer_form" >
    <input type="hidden" name="class_id" value="<?= $class->class_id ?>" >
    <div class="card-group justify-content-center">
        <?php if($users) : ?>
            <?php foreach ($users as $user ): ?>
                <div class="card m-2" style="max-width: 14rem;min-width: 14rem;">
                    <?php include view_path('includes/singleUser'); ?>                    
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <h2>No Lecturers found</h2>
        <?php endif; ?> 
    </div>
</form>
<script>
    const showLecturerForm  = document.getElementById('sms-show_lecturer_form');
    const userSelectBtn     = showLecturerForm.querySelectorAll('.sms-user_select_btn');

    userSelectBtn.forEach(element => {
        element.innerHTML = 'Remove';
        element.classList.remove('btn-success');
        element.classList.add('btn-danger');
    });
</script>