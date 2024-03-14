<?php 
    /**
     * This is add tests file for class 
     */
?>
<nav class="navbar navbar-light bg-light">
    <form class="form-inline d-flex">
        <input class="form-control mr-sm-2" type="search" placeholder="Search Tests" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <span id="addNewSchool" class="btn btn-primary" >Add Test</span>
</nav>

<div class="card-group justify-content-center">
    <table class="table table-striped table-hover" >
        <tr>
            <th>Test Name</th>
            <th>Created By</th>
            <th>Active</th>
            <th>Created At</th>
        </tr>

        <?php if($tests) : ?>
            <?php foreach ($tests as $test ): ?>
                <tr>
                    <td><a href="<?= ROOT  ?>" class="text-decoration-none" ><?= esc($test->test_title) ?></a></td>
                    <td><a href="<?= ROOT . 'profile/'. $test->user_id->user_id ?>" class="text-decoration-none" ><?= esc($test->user_id->fname) .' '. esc($test->user_id->lname)  ?></a></td>
                    <td class="<?= $test->disabled == '0' ? 'text-success' : 'text-danger' ?>" >Yes</td>
                    <td><?= get_date($test->date) ?></td>
                </tr>
                
            <?php endforeach; ?>
            <?php  else: ?>
                <tr class="text-center" ><td colspan="5">No Tests found</td></tr>
            <?php endif; ?>
    </table>
</div>

<div class="sms-add_new_school" >
    <div class="sms-school_form border shadow p-4" >
        <form action="<?= ROOT . 'tests/add' ?>" method="post" class="clear-fix" >
            <h3 class="text-center" >Add Test</h3>
            <input type="hidden" name="class_id" value="<?= $class->class_id ?>" >
            <input type="text" name="test_title" class="form-control" placeholder="Type test title" >
            <textarea name="description" class="form-control mt-2" style="resize:none;" placeholder="Your test description is here." ></textarea>
            
            <input type="submit" class="btn btn-primary float-end mt-4" value="Add Test">
            <span class="btn btn-danger mt-4" id="addNewSchoolCancel" >Cancel</span>
        </form>
    </div>
</div>