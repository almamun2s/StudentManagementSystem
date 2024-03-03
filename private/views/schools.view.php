<?php $this->view('includes/header') ?>
    <div class="container-fluid p-4 shadow">
        <?php $this->view('includes/b_crumb') ?>

        <div class="card-group justify-content-center">
            <table class="table table-striped table-hover" >
                <tr>
                    <th>School</th>
                    <th>Created By</th>
                    <th>Date</th>
                    <th>
                        <span class="btn btn-primary" id="addNewSchool" ><i class="fas fa-plus"></i> Add new School</span>
                    </th>
                </tr>
                <?php if($schools) : ?>
                    <?php foreach ($schools as $school ): ?>
                        <tr>
                            <td><?= $school->school_name ?></td>
                            <td><?= $school->user_id->fname.' '.$school->user_id->lname ?></td>
                            <td><?= get_date($school->date) ?></td>
                            <td>
                                <button class="btn btn-info text-white" ><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger" ><i class="fas fa-trash"></i></button>
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
    <div class="sms-add_new_school">
        <div class="sms-school_form border shadow p-4">
            <form action="schools/add" method="post">
                <h3>Add new School</h3>
                <input type="text" name="school_name" class="form-control" autofocus placeholder="School Name" >
                <input type="submit" value="Create" class="btn btn-primary mt-4 float-end" >

                <span class="btn btn-danger mt-4" id="addNewSchoolCancel" >Cancel</span>
            </form>
        </div>
    </div>
<?php $this->view('includes/footer') ?>