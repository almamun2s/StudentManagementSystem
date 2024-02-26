<?php $this->view('includes/header') ?>
    <div class="container-fluid">
        <div class="p-4 mt-4 mx-auto rounded shadow" style="width:100%;max-width: 325px;">
            <h2 class="text-center" >Add User</h2>
            <input name="fname" placeholder="First Name" type="text" class="my-4 form-control" autofocus autocomplete="off">
            <input name="lname" placeholder="Last Name" type="text" class="my-4 form-control" autocomplete="off">
            <input name="email" placeholder="Email" type="email" class="my-4 form-control" autocomplete="off">

            <select name="gender" class="my-4 form-control" >
                <option value="">--Select a Gender--</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <select name="rank" class="my-4 form-control" >
                <option value="">--Select a Rank--</option>
                <option value="student">Student</option>
                <option value="reception">Reception</option>
                <option value="lecturer">Lecturer</option>
                <option value="admin">Admin</option>
                <option value="super_admin">Super Admin</option>
            </select>

            <input name="password" placeholder="Password" type="text" class="my-4 form-control" autocomplete="off">
            <input name="password2" placeholder="Password" type="text" class="my-4 form-control" autocomplete="off">

            <button class="btn btn-primary float-end">Add User</button>
            <button class="btn btn-danger text-white">Cancel</button>
        </div>
    </div>
    
<?php $this->view('includes/footer') ?>