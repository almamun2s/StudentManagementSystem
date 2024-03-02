const addSchoolBtn      = document.getElementById('addNewSchool');
const addSchoolCancel   = document.getElementById('addNewSchoolCancel');
const addSchoolPopup    = document.querySelector('.sms-add_new_school');

addSchoolBtn.addEventListener('click', function(){
    addSchoolPopup.classList.add('sms-add_new_school_show');
});

addSchoolCancel.addEventListener('click', function(){
    addSchoolPopup.classList.remove('sms-add_new_school_show');
});