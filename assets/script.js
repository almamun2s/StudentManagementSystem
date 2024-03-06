const addSchoolBtn      = document.getElementById('addNewSchool');
const addSchoolCancel   = document.getElementById('addNewSchoolCancel');
const addSchoolPopup    = document.querySelector('.sms-add_new_school');

addSchoolBtn.addEventListener('click', function(){
    addSchoolPopup.classList.add('sms-add_new_school_show');
});

addSchoolCancel.addEventListener('click', function(){
    addSchoolPopup.classList.remove('sms-add_new_school_show');
});


function showEditPopup(schoolId) {
    document.getElementById(schoolId).classList.add('sms-add_new_school_show');
}
function hideEditPopup(schoolId) {
    document.getElementById(schoolId).classList.remove('sms-add_new_school_show');
}

document.addEventListener('keydown', function(event) {
    if (event.key === "Escape") {
        addSchoolPopup.classList.remove('sms-add_new_school_show');
    }
});