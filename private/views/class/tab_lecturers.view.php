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
        <div class="card-group justify-content-center" id="sms-search_class_lecturers_response" ></div>

    </div>
</div>