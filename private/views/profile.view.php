<?php $this->view('includes/header') ?>
    <div class="container-fluid p-4 shadow mx-auto" style="max-width: 1200px;">
        <?php $this->view('includes/b_crumb') ?>
        <div class="row">
            <div class="col-4">
                <img src="assets/img/user_female.jpg" class="border border-primary d-block mx-auto rounded-circle" style="width:150px" >
            </div>
            <div class="col-8 bg-light p-2">
                <table class="table table-hover table-striped table-bordered" >
                    <tr>
                        <th>First Name:</th>
                        <td>Jane</td>
                    </tr>
                    <tr>
                        <th>Last Name:</th>
                        <td>Doe</td>
                    </tr>
                    <tr>
                        <th>Gender:</th>
                        <td>Female</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
<?php $this->view('includes/footer') ?>