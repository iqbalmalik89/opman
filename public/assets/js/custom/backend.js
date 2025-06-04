var server = window.location.hostname;
var catOptions = "";

if (server == 'site-manager.local') {
    var canvasUrl = location.protocol + "//" + server + "/";
} 
else {
    var canvasUrl = location.protocol + "//"+server+"/";
}



var config = {};

// Front app url
config.webURL = canvasUrl;
config.tenantURL = canvasUrl + 'tenancy/assets/';


config.adminURL = canvasUrl + 'admin/' ;

// API url
config.apiURL = canvasUrl + "api/";

// javascript validation on/off
config.client_validation = false;
var fullPhone = "";

var projectStatus = {'Planning': 'primary', 'Active':'info', 'Complete':'success', 'Handover': 'danger'};
var companyStatus = {'Active': 'success', 'Suspended': 'warning', 'Deleted':'danger'};


var globalFormId;
var globalFormBtn;
var globalModule;

function c(value)
{
	console.log(value);
}



$( document ).ajaxStart(function() {
    if(typeof globalFormId != 'undefined')
    {

        form = document.querySelector(globalFormId);
        submitButton = document.querySelector(globalFormBtn);
        submitButton.setAttribute('data-kt-indicator', 'on');
        submitButton.disabled = true;

    }

});

$( document ).ajaxComplete(function() {
    if(typeof globalFormId != 'undefined')
    {
        form = document.querySelector(globalFormId);
        submitButton = document.querySelector(globalFormBtn);
        submitButton.setAttribute('data-kt-indicator', 'off');
        submitButton.disabled = false;        
    }

});


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$( document ).ready(function() {
    // subcontractorTeams(2);


    printThis();
    if($('#phone').length)
    {
        var phone = document.querySelector("#phone");
          fullPhone = window.intlTelInput(phone, {
            utilsScript: config.webURL + "assets/js/utils.js",
            showSelectedDialCode:true,
            initialCountry: "GB",
            // hiddenInput: "full"
        });        
    }


    if($('#people_chart').length)
    {
        renderStats();        
    }

    select2Patch('#doc_add_form select[name^="cat_id"]', "#document_upload");
    // $('select[name^="cat_id"]').select2({
    //     dropdownParent: $("#document_upload")
    // });



    // viewProject(10);
    // manageSubcontractorTeams(12);

    if($('.load-project').length)
        viewProject($('.load-project').val());






    $('select#subcontractor_id').select2({
        placeholder: "Select Subcontractor",
    });



    if($('#subcontractor_id').length > 0)
    {
        if(typeof $('.manage-subcontractor #subcontractor_id').val() != 'undefined')
        {
            manageSubcontractorTeams($('#subcontractor_id').val());
            subcontractorTeams($('#subcontractor_id').val());
        }
        else
        {
            getSubcontractorTeams($('#subcontractor_id').val());
        }

    }

    if($('#people_form').length > 0)
    {
        catOptions = $('select[name^="cat_id"]').html()

        $('select[name^="doc_class"]').select2({
            placeholder: "Select Certification",
        });         

        var unsaved = false;

        $(":input").change(function(){ //triggers change in all input fields including text type
            unsaved = true;
        });

        function unloadPage(){ 
            if(unsaved){
                return "You have unsaved changes on this page. Do you want to leave this page and discard your changes or stay on this page?";
            }
        }

        window.onbeforeunload = unloadPage;     
    }

    if($('#suboperative_form').length > 0)
    {
        catOptions = $('select[name^="cat_id"]').html()

        $('select[name^="doc_class"]').select2({
            placeholder: "Select Certification",
        });         

    }




    initDZUploader("#replace_doc", 1);
    initDZUploader("#files", 0);
    initDZUploader("#docfiles", 1);
    initDZUploader("#gross_status", 0);

    if($('#documents').length > 0)
        getDocuments();

    if($('.site-list').length > 0)
        searchSite();

    if($('.subcontractor-list').length > 0)
        searchSubcontractor();


    catOptions = $('select[name^="cat_id"]').html()



//     $('#skill').on('change', function (e) {
// 
// //         if(typeof $('#skill').val() != 'object' && $('#skill').val() != '')
// //         {
// //             searchPeople(true);
// // 
// //         }
// 
//             searchPeople(true);
// 
//         // else
//         //  searchPeople(false);
//     });
// 
// 
// 
//     $('#postcode').on('change', function (e) {
//         searchPeople(true);
//     });
// 
//     $('#status').on('change', function (e) {
//         searchPeople(true);
//     });

    initDatePicker("[name^='dob'],[name^='employ_start'],[name^='holiday_from'], [name^='holiday_to'], [name^='expire_at'], [name='start_date'], [name='due_date'], [name='course_date']")


    $(":input").on("keyup change", function(e) {
        var name = $(this).prop('name');

        if(name.indexOf('[]') !== -1)
        {

            if($(this).prop('nodeName') == 'SELECT')
                $(this).parent().find('.invalid-feedback').remove();
            else
                $(this).parent().find('.invalid-feedback').remove(); 

        }
        else
        {
            //name = name.replace("[]", "")
            $('#' + name + '_error').remove();
        }

    })
    

    if($('#setting-form').length > 0)
    {
        if($('#logo_img_path').val() == '')
        {
            initDropzone('logo_img')
        }

        if($('#splash_img_path').val() == '')
        {
            initDropzone('splash_img')
        }

        if($('#splash_bg_img_path').val() == '')
        {
            initDropzone('splash_bg_img')
        }

        if($('#favicon_img_path').val() == '')
        {
            initDropzone('favicon_img')
        }





    }



    if($('#people_expired_listing').length > 0)
    {
        getPeopleExpiredDocuments.init();
    }

    if($('#suboperative_expired_listing').length > 0)
    {
        getSuboperativeExpiredDocuments.init();
    }

    if($('#client_listing').length > 0)
    {
        getClientListing.init();
    }

    if($('#banned_listing').length > 0)
    {
        getBannedListing.init();
    }



    if($('#deactivated_listing').length > 0)
    {
        getDeactivatedListing.init();
    }

    if($('#category_listing').length > 0)
    {
        getCategoryListing.init();
    }

    if($('#backup_listing').length > 0)
    {
        getBackupListing.init();
    }

    if($('#training_listing').length > 0)
    {
        getTrainingListing.init('Active');
    }

    if($('#training_pending_listing').length > 0)
    {
        getTrainingListing.init('Pending');
    }

    if($('.projects-list').length > 0)
    {
        getProjects();
    }


    $("#people_form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';

      //   var form = $( globalFormId );
      // var formData = new FormData(form[0]);
      // c(formData)

      addUpdatePeople(this);
    });


    $("#doc_add_form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      addDocuments();
    });




    $("#client-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      addUpdateClient();
    });

    $("#project-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      addUpdateProject();
    });

    $("#site-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      addUpdateSite();
    });


    $("#training_form").submit(function(e) {

      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      var download = 0;
      if($(e.originalEvent.submitter).attr('id') == 'training_form_btn')
      {
          globalFormBtn = globalFormId + '_btn';
      }
      else
      {              
          globalFormBtn = globalFormId + '_download_btn';
          var download = 1;

      }
      addUpdateTraining(download);
    });


    $("#subcontractor-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      addUpdateSubcontractor();
    });

    // project

    if($('#certification_listing').length > 0)
    {
        getCertificationListing.init();
    }

    if($('#team_listing').length > 0)
    {
        getTeamListing.init();
    }

    if($('#suboperative_listing').length > 0)
    {
        getSuboperativeListing.init();
    }


    $("#category-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      addUpdateCategory();
    });



    $("#certification-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      addUpdateCertification();
    });



    $("#two_fact_form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '_btn';
      populateCode();
      verifyCode();
    });


    $("#team-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      addUpdateTeam();
    });

    $("#teamtask-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      addUpdateTeamTask();
    });

    $("#suboperative_form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      addUpdateSuboperative(this);
    });

    $("#doc_form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      updateDocument();
    });

    $("#assign_form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      assignUser();
    });

    // users
    if($('#user_listing').length > 0)
    {
        getUserListing.init();
    }

    if($('#company_listing').length > 0)
    {
        getCompanyListing.init();
    }

    if($('#people_listing').length > 0)
    {
        getPeopleListing.init();
    }

    $("#setting-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      addUpdateSettings();
    });

    $("#alert-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      addAlertEmails();
    });

    $("#user-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';

      //   var form = $( globalFormId );
      // var formData = new FormData(form[0]);
      // c(formData)

      addUpdateUser(this);
    });

    $("#tenant-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      addUpdateCompany(this);
    });


    // $("#user-form").submit(function(e) {
    //   e.preventDefault();
    //   globalFormId = '#' + $(this).attr("id");
    //   globalFormBtn = globalFormId + '-btn';
    //   addUpdateUser(this);
    // });

    $("#profile-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      updateProfile();
    });

    $("#security-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      updateSecurity();
    });

    $("#resetpass-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      resetPassword();
    });





    $("#register-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      register();
    });


    $("#page-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      login();
    });

    $("#forgot-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      sendRequestPasswordEmail();
    });

    if($('#site_listing').length > 0)
    {
        getSiteListing.init();
    }

    if($('#subcontractor_listing').length > 0)
    {
        getSubcontractorListing.init();
    }

    $("#customer-form").submit(function(e) {
      e.preventDefault();
      globalFormId = '#' + $(this).attr("id");
      globalFormBtn = globalFormId + '-btn';
      addUpdateCustomer();
    });





});



function addUpdateUser(obj)
{
    $('input[name="phone_full"]').val(fullPhone.getNumber());

   var formData = new FormData(obj);


    $.ajax({
        type: 'POST',
        url: config.apiURL + 'user' + route() ,
        dataType:"JSON",
        processData: false,
        contentType: false,
        cache: false,
        data:  formData,
        enctype: 'multipart/form-data',


        beforeSend:function(){


        },
        success:function(data){

            showNotif(globalFormId + '-msg', data.message, 'success');
            window.location = config.adminURL + 'users';            

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}


function addUpdateSettings()
{

    $.ajax({
        type: getMethod(),
        url: config.apiURL + 'setting' + route() ,
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){

            showNotif(globalFormId + '-msg', data.message, 'success');
            window.location.reload();

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}



function addAlertEmails()
{

    $.ajax({
        type: 'Put',
        url: config.apiURL + 'setting/alert',
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){

            showNotif(globalFormId + '-msg', data.message, 'success');

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}

function updateProfile()
{
    $.ajax({
        type: 'PUT',
        url: config.apiURL + 'profile',
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){

            showNotif(globalFormId + '-msg', data.message, 'success');
        },
        error:function(xhr, ajaxOptions, thrownError){
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}


function updateSecurity()
{
    $.ajax({
        type: 'PUT',
        url: config.apiURL + 'security',
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){

            showNotif(globalFormId + '-msg', data.message, 'success');
        },
        error:function(xhr, ajaxOptions, thrownError){
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}

function login()
{
    $.ajax({
        method : "POST", 
        type: "POST",
        url: config.apiURL + 'user/login' ,
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){

            if(data.status == 'success')
            {
                showNotif('#login_msg', data.message, 'success');

                if(data.tenant == 0)
                    window.location = config.adminURL + 'dashboard';            
                else
                    window.location = data.data.url + '?token=' + data.data.token;                            
            }
            else if(data.status == 'suspended')
            {
                showNotif('#login_msg', data.message, 'error');

            }
            else if(data.status == 'sent')
            {

                $('#two_fact_msg').html('Please input code which we have sent on your ' + data.two_fact_auth);
                $('#two_fact_modal').modal('show');
                handleFactAuthCode('#two_fact_form');

            }


        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, '#login_msg')
        }
    });         
}



function register()
{
    $('input[name="phone_full"]').val(fullPhone.getNumber());

    $.ajax({
        method : "POST", 
        type: "POST",
        url: config.apiURL + 'tenant' ,
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){

            showNotif('#login_msg', data.message, 'success');
            window.location = config.adminURL + 'login';            

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, '#login_msg')
        }
    });         
}

function c(data)
{
    console.log(data);
}

function parseErrors(jsonResp, id)
{

    var messages = '';
    var errorJson = jQuery.parseJSON(jsonResp);


    if (typeof errorJson.errors != "undefined") 
    {
        var ObjectCount = Object.keys(errorJson.errors).length;

        if(ObjectCount > 0)
        {
            $('.invalid-feedback').remove();
            $.each(errorJson.errors, function( field, errorObj ) {
                //$('#' + field).parent().addClass('is-invalid');
                //messages += errorObj;

                var errorHtml = `<div id="${field}_error" class="fv-plugins-message-container invalid-feedback">
                                    <div data-field="text_input" data-validator="notEmpty">
                                        ${errorObj}
                                    </div>
                                 </div>`;




                if((field.indexOf('.') !== -1))
                {
                    const fieldArr = field.split(".");
                    var input = $("input[name='"+fieldArr[0]+"[]']").eq(fieldArr[1]).prop('nodeName');
                    var select = $("select[name='"+fieldArr[0]+"[]']").eq(fieldArr[1]).prop('nodeName');

                    if(typeof input != 'undefined'){

                        $("input[name='"+fieldArr[0]+"[]']").eq(fieldArr[1]).after(errorHtml);
                    }
                    else if(typeof select != 'undefined')
                    {
                        $("select[name='"+fieldArr[0]+"[]']").eq(fieldArr[1]).next('span').after(errorHtml);
                    }
                }
                else
                {

                    if($('[name="'+field+'"]').prop('nodeName') == 'SELECT')
                    {
                        $('[name="'+field+'"]').next('span').after(errorHtml);
                    }
                    else
                    {
                        if($('[name="'+field+'"]').prop('type') == 'radio')
                        {
                            $('[name="'+field+'"]').parent().after(errorHtml);
                        }
                        else
                        {
                            $('[name="'+field+'"]').after(errorHtml);
                        }
                    }
                }


                // if((field.indexOf('.') === -1) &&  $('[name="'+field+'"]').prop('nodeName') == 'SELECT')
                // {
                //     $('[name="'+field+'"]').next('span').after(errorHtml);
                // }
                // else
                // {
                //     // text field case
                //     if(field.indexOf('.') !== -1)
                //     {
                //         const fieldArr = field.split(".");
                //         $("input[name='"+fieldArr[0]+"[]']").eq(fieldArr[1]).after(errorHtml)

                //     }
                //     else
                //     {
                //         $('[name="'+field+'"]').after(errorHtml);
                //     }

                // }


            });



            if(messages != '')
            {
//                showNotif(id, messages, 'error');
            }
        }
    }
    else
    {
        if(errorJson.status == 'error')
        {
            showNotif(id, errorJson.message, 'error');
        }
    }       
}

function initDatePicker(name)
{
    if($(name).length > 0)
    {

        var date = $(name);

        date.flatpickr({
            enableTime: false,
            dateFormat: "d/m/Y",
            autoClose: true
        });



        // $(name).flatpickr({
        //        onChange: function(selectedDates, dateStr, instance){
        //             instance.close();
        //         }
        //  })        
    }


}

function initMinMaxDatePicker(name, min, max)
{
    if($(name).length > 0)
    {

        var date = $(name);

        date.flatpickr({
            enableTime: false,
            dateFormat: "d/m/Y",
            autoClose: true,
            minDate: min,
            maxDate: max
        });
    }
}


function showNotif(elm, message, alertType, redirUrl)
{
    var msgConfig = {
                        "error":
                            {
                                "title":"Error",
                                "message":message,
                                "alert_class":"bg-light-danger",
                                "svg_close_icon":`<span class="svg-icon svg-icon-1 svg-icon-danger">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                                            </svg>
                                                        </span>`,
                                "svg_icon":`<span class="svg-icon svg-icon-2hx svg-icon-danger me-4 mb-5 mb-sm-0">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="currentColor"></path>
                                                            <path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>`
                            },
                        "info":
                            {
                                "title":"Info",
                                "message":message,
                                "alert_class":"bg-light-primary",
                                "svg_close_icon":`<span class="svg-icon svg-icon-1 svg-icon-primary">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                                            </svg>
                                                        </span>`,
                                "svg_icon":`<span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3" d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" fill="currentColor"></path>
                                                            <path d="M20 8L14 2V6C14 7.10457 14.8954 8 16 8H20Z" fill="currentColor"></path>
                                                            <rect x="13.6993" y="13.6656" width="4.42828" height="1.73089" rx="0.865447" transform="rotate(45 13.6993 13.6656)" fill="currentColor"></rect>
                                                            <path d="M15 12C15 14.2 13.2 16 11 16C8.8 16 7 14.2 7 12C7 9.8 8.8 8 11 8C13.2 8 15 9.8 15 12ZM11 9.6C9.68 9.6 8.6 10.68 8.6 12C8.6 13.32 9.68 14.4 11 14.4C12.32 14.4 13.4 13.32 13.4 12C13.4 10.68 12.32 9.6 11 9.6Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>`
                            },
                        "success":
                            {
                                "title":"Success",
                                "message":message,
                                "alert_class":"bg-light-success",
                                "svg_close_icon":`<span class="svg-icon svg-icon-1 svg-icon-success">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                                            </svg>
                                                        </span>`,
                                "svg_icon":`<span class="svg-icon svg-icon-2hx svg-icon-success me-4 mb-5 mb-sm-0">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>`
                            },
                        "warning":
                            {
                                "title":"Warning",
                                "message":message,
                                "alert_class":"bg-light-info",
                                "svg_close_icon":`<span class="svg-icon svg-icon-1 svg-icon-info">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                                            </svg>
                                                        </span>`,
                                "svg_icon":`<span class="svg-icon svg-icon-2hx svg-icon-info me-4 mb-5 mb-sm-0">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="currentColor"></path>
                                                            <path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>`,
                            }




                    };

    var data = msgConfig[alertType];

    var html = `<div class="alert alert-dismissible ${data.alert_class} d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/files/fil024.svg-->
                    ${data.svg_icon}
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <!--begin::Content-->
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <h4 class="fw-semibold">${data.title}</h4>
                        <span>${data.message}</span>
                    </div>
                    <!--end::Content-->
                    <!--begin::Close-->
                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        ${data.svg_close_icon}
                        <!--end::Svg Icon-->
                    </button>
                    <!--end::Close-->
                </div>`;


    $(elm).html(html);


    if(typeof redirUrl != "undefined" && redirUrl != '')
    {

        setTimeout(function() { 
           window.location = redirUrl;
        }, 1000);

    }


}

















// On document ready
function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function route(id)
{
    var slug = '';
    if(typeof id != 'undefined' && id != '')
    {
        slug = id
    }
    else
    {
        slug = $('#module_id').val() || '';
    }

    if(slug != '')
        slug = '/' + slug;

    return slug;
}


function getMethod()
{
    var method = 'POST';
    var id = $.trim($('#module_id').val())
    if(id != '')
        method = 'PUT';
    return method;
}

function sendRequestPasswordEmail()
{
    $.ajax({
        method : "POST", 
        type: "POST",
        url: config.apiURL + 'request-password' ,
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){

            showNotif(globalFormId + '-msg', data.message, 'success');
//            window.location = config.adminURL + 'login';            

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}

function resetPassword()
{
    $.ajax({
        type: "PUT",
        url: config.apiURL + 'reset-password/' + $('#token').val() ,
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){
            let redirUrl = config.adminURL + 'login';
            showNotif(globalFormId + '-msg', data.message, 'success', redirUrl);


        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}
 


function addUpdateCustomer()
{

    $.ajax({
        type: getMethod(),
        url: config.apiURL + 'customer' + route() ,
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){

            showNotif(globalFormId + '-msg', data.message, 'success');
            window.location = config.adminURL + 'customers';            

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}



"use strict";

// Class definition
var getUserListing = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var module = $('.module').data('module');

    // Private functions
    var initDatatable = function () {
        dt = $("#"+module+"_listing").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                // url: "https://preview.keenthemes.com/api/datatables.php",
                url: config.apiURL + module +'s',

            },
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'role' },

                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function (data) {

                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="rec-checkbox form-check-input" type="checkbox" value="${data}" />
                            </div>`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {
                       console.log(data);

                         return `${row.first_name}`+` `+`${row.last_name}`;
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, row) {
                        return `${capitalizeFirstLetter(row.roles[0].name)}`;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {


                        var editHtml = '';
                        var deleteHtml = '';

                        if(p.editUser)
                        {
                            editHtml = `<div class="menu-item px-3">
                                    <a href="${config.adminURL}${module}/edit/${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="edit_row">
                                        Edit
                                    </a>
                                </div>`;
                        }

                        if(p.deleteUser)
                        {
                            deleteHtml = `<div class="menu-item px-3">
                                    <a href="#" data-id="${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="delete_row">
                                        Delete
                                    </a>
                                </div>`;
                        }


                        return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                ${editHtml}
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                ${deleteHtml}
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
            ],
            // Add data-filter attribute
            // createdRow: function (row, data, dataIndex) {
            //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            // }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-'+module+'-table-filter="search"]');

        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    // var handleFilterDatatable = () => {
    //     // Select filter options
    //     filterPayment = document.querySelectorAll('[data-kt-user-table-filter="payment_type"] [name="payment_type"]');
    //     const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');

    //     // Filter datatable on submit
    //     filterButton.addEventListener('click', function () {
    //         // Get filter values
    //         let paymentValue = '';

    //         // Get payment value
    //         filterPayment.forEach(r => {
    //             if (r.checked) {
    //                 paymentValue = r.value;
    //             }

    //             // Reset payment value if "All" is selected
    //             if (paymentValue === 'all') {
    //                 paymentValue = '';
    //             }
    //         });

    //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         dt.search(paymentValue).draw();
    //     });
    // }

    // Delete customer
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-'+module+'-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const recName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + recName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                            deleteData($(e.target).data('id'), dt);

                    } 
                });
            })
        });
    }

    var deleteData = (id, dt) => {

        $.ajax({
            type: 'DELETE',
            url: config.apiURL + module ,
            dataType:"JSON",
            data: {id: id},
            beforeSend:function(){


            },
            success:function(data){

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    dt.draw();
                });


            },
            error:function(xhr, ajaxOptions, thrownError){
                //parseErrors(xhr.responseText, globalFormId + '-msg')
            }
        });        

    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-'+module+'-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Reset payment type
            filterPayment[0].checked = true;

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            dt.search('').draw();
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#'+module+'_listing');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-'+module+'-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {

            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete selected records?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                },
            }).then(function (result) {
                if (result.value) {
                    // Simulate delete request -- for demo purpose only

                        let ids = [];
                        $(".rec-checkbox:checked").each(function() {
                            ids.push(this.value);
                        });                        

                        deleteData(ids, dt);

                        // Swal.fire({
                        //     text: "You have deleted all selected records!.",
                        //     icon: "success",
                        //     buttonsStyling: false,
                        //     confirmButtonText: "Ok, got it!",
                        //     customClass: {
                        //         confirmButton: "btn fw-bold btn-primary",
                        //     }
                        // }).then(function () {
                        //     // delete row data from server and re-draw datatable
                        //     dt.draw();
                        // });

                        // Remove header checked box
                        const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;

                }
            });
        });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#'+module+'_listing');
        const toolbarBase = document.querySelector('[data-kt-'+module+'-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-'+module+'-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-'+module+'-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Public methods
    return {
        init: function () {

            initDatatable();
            handleSearchDatatable();
            initToggleToolbar();
            //handleFilterDatatable();
            handleDeleteRows();
            handleResetForm();
        }
    }
}();


var getCompanyListing = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var module = $('.module').data('module');

    // Private functions
    var initDatatable = function () {
        dt = $("#"+module+"_listing").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                // url: "https://preview.keenthemes.com/api/datatables.php",
                url: config.apiURL + 'companies',

            },
            columns: [
                { data: 'id' },
                { data: 'company' },
                { data: 'super_admin' },
                { data: 'email' },
                { data: 'status' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function (data) {

                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="rec-checkbox form-check-input" type="checkbox" value="${data}" />
                            </div>`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {
                       console.log(data);

                         return `${row.name}`;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, row) {
                        return `${row.super_admin.first_name} ${row.super_admin.last_name}`;
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, row) {
                        return `${row.super_admin.email}`;
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, row) {
                        return `<span class="badge badge-light-${companyStatus[row.status]}">${row.status}</span>`;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {
                        return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="${config.adminURL}${module}/edit/${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="edit_row">
                                        Edit
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" data-id="${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="delete_row">
                                        Delete
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
            ],
            // Add data-filter attribute
            // createdRow: function (row, data, dataIndex) {
            //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            // }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-'+module+'-table-filter="search"]');

        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    // var handleFilterDatatable = () => {
    //     // Select filter options
    //     filterPayment = document.querySelectorAll('[data-kt-user-table-filter="payment_type"] [name="payment_type"]');
    //     const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');

    //     // Filter datatable on submit
    //     filterButton.addEventListener('click', function () {
    //         // Get filter values
    //         let paymentValue = '';

    //         // Get payment value
    //         filterPayment.forEach(r => {
    //             if (r.checked) {
    //                 paymentValue = r.value;
    //             }

    //             // Reset payment value if "All" is selected
    //             if (paymentValue === 'all') {
    //                 paymentValue = '';
    //             }
    //         });

    //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         dt.search(paymentValue).draw();
    //     });
    // }

    // Delete customer
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-'+module+'-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const recName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + recName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                            deleteData($(e.target).data('id'), dt);

                    } 
                });
            })
        });
    }

    var deleteData = (id, dt) => {

        $.ajax({
            type: 'DELETE',
            url: config.apiURL + module ,
            dataType:"JSON",
            data: {id: id},
            beforeSend:function(){


            },
            success:function(data){

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    dt.draw();
                });


            },
            error:function(xhr, ajaxOptions, thrownError){
                //parseErrors(xhr.responseText, globalFormId + '-msg')
            }
        });        

    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-'+module+'-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Reset payment type
            filterPayment[0].checked = true;

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            dt.search('').draw();
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#'+module+'_listing');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-'+module+'-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {

            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete selected records?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                },
            }).then(function (result) {
                if (result.value) {
                    // Simulate delete request -- for demo purpose only

                        let ids = [];
                        $(".rec-checkbox:checked").each(function() {
                            ids.push(this.value);
                        });                        

                        deleteData(ids, dt);

                        // Swal.fire({
                        //     text: "You have deleted all selected records!.",
                        //     icon: "success",
                        //     buttonsStyling: false,
                        //     confirmButtonText: "Ok, got it!",
                        //     customClass: {
                        //         confirmButton: "btn fw-bold btn-primary",
                        //     }
                        // }).then(function () {
                        //     // delete row data from server and re-draw datatable
                        //     dt.draw();
                        // });

                        // Remove header checked box
                        const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;

                }
            });
        });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#'+module+'_listing');
        const toolbarBase = document.querySelector('[data-kt-'+module+'-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-'+module+'-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-'+module+'-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Public methods
    return {
        init: function () {

            initDatatable();
            handleSearchDatatable();
            initToggleToolbar();
            //handleFilterDatatable();
            handleDeleteRows();
            handleResetForm();
        }
    }
}();


var getPeopleListing = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var module = $('.module').data('module');

    // Private functions
    var initDatatable = function () {
        dt = $("#"+module+"_listing").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                // url: "https://preview.keenthemes.com/api/datatables.php",
                url: config.apiURL + module +'s?people_type=' + $('input[name="people_type"]').val(),

            },
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'mobile' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function (data) {

                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="rec-checkbox form-check-input" type="checkbox" value="${data}" />
                            </div>`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {
                         return `${row.first_name}`+` `+`${row.last_name}`;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, row) {
                         if(row.project !== null)
                             return `${row.project.job_no}`;
                        else
                            return ``;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {

                        var editHtml = '';
                        var deleteHtml = '';

                        if(p.editPeople)
                        {
                            editHtml = `<div class="menu-item px-3">
                                    <a href="${config.adminURL}${module}/edit/${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="edit_row">
                                        Edit
                                    </a>
                                </div>`;
                        }

                        if(p.deletePeople)
                        {
                            deleteHtml = `<div class="menu-item px-3">
                                    <a href="#" data-id="${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="delete_row">
                                        Delete
                                    </a>
                                </div>`;
                        }


                        return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                ${editHtml}
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                ${deleteHtml}
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
            ],
            // Add data-filter attribute
            // createdRow: function (row, data, dataIndex) {
            //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            // }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-'+module+'-table-filter="search"]');

        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    // var handleFilterDatatable = () => {
    //     // Select filter options
    //     filterPayment = document.querySelectorAll('[data-kt-user-table-filter="payment_type"] [name="payment_type"]');
    //     const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');

    //     // Filter datatable on submit
    //     filterButton.addEventListener('click', function () {
    //         // Get filter values
    //         let paymentValue = '';

    //         // Get payment value
    //         filterPayment.forEach(r => {
    //             if (r.checked) {
    //                 paymentValue = r.value;
    //             }

    //             // Reset payment value if "All" is selected
    //             if (paymentValue === 'all') {
    //                 paymentValue = '';
    //             }
    //         });

    //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         dt.search(paymentValue).draw();
    //     });
    // }

    // Delete customer
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-'+module+'-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const recName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + recName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                            deleteData($(e.target).data('id'), dt);

                    } 
                });
            })
        });
    }

    var deleteData = (id, dt) => {

        $.ajax({
            type: 'DELETE',
            url: config.apiURL + module ,
            dataType:"JSON",
            data: {id: id},
            beforeSend:function(){


            },
            success:function(data){

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    dt.draw();
                });


            },
            error:function(xhr, ajaxOptions, thrownError){
                //parseErrors(xhr.responseText, globalFormId + '-msg')
            }
        });        

    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-'+module+'-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Reset payment type
            filterPayment[0].checked = true;

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            dt.search('').draw();
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#'+module+'_listing');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-'+module+'-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {

            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete selected records?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                },
            }).then(function (result) {
                if (result.value) {
                    // Simulate delete request -- for demo purpose only

                        let ids = [];
                        $(".rec-checkbox:checked").each(function() {
                            ids.push(this.value);
                        });                        

                        deleteData(ids, dt);

                        // Swal.fire({
                        //     text: "You have deleted all selected records!.",
                        //     icon: "success",
                        //     buttonsStyling: false,
                        //     confirmButtonText: "Ok, got it!",
                        //     customClass: {
                        //         confirmButton: "btn fw-bold btn-primary",
                        //     }
                        // }).then(function () {
                        //     // delete row data from server and re-draw datatable
                        //     dt.draw();
                        // });

                        // Remove header checked box
                        const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;

                }
            });
        });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#'+module+'_listing');
        const toolbarBase = document.querySelector('[data-kt-'+module+'-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-'+module+'-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-'+module+'-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Public methods
    return {
        init: function () {

            initDatatable();
            handleSearchDatatable();
            initToggleToolbar();
            //handleFilterDatatable();
            handleDeleteRows();
            handleResetForm();
        }
    }
}();


function initDropzone(id)
{
    var myDropzone = new Dropzone("#" + id, {
        url: config.apiURL + 'media/upload?_token=' + $('meta[name="csrf-token"]').attr('content'),
        paramName: "file", // The name that will be used to transfer the file
        maxFiles: 1,
        maxFilesize: 10, // MB
        addRemoveLinks: true,
    });

    myDropzone.on("complete", function (file) {
        let fileJson = jQuery.parseJSON(file.xhr.response);
        if(fileJson.status == 'success')
        {
            $('#' +id + ' input').val(fileJson.new);
        }
        else if(fileJson.status == 'error')
        {
          myDropzone.removeFile(file);
          $('#' +id).parent().find('span').html(fileJson.message);
        }
    });

    // $('#' + id).dropzone({
        // url: config.apiURL + 'media/upload?_token=' + $('meta[name="csrf-token"]').attr('content'),
    //     paramName: 'file', // The name that will be used to transfer the file
    //     maxFiles: 1,
    //     maxFilesize: 5, // MB
    //     addRemoveLinks: true,
    //     accept: function(file, done) {

    //             done();


    //     }
    // });

}

function removeFile(id)
{
    $('#' + id + ' .dz-preview').remove();
    $('#' + id + ' .dropzone-msg').removeClass('d-none');
    $('#' + id + ' input').val('');
    initDropzone(id);
}

var getCategoryListing = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var module = $('.module').data('module');

    // Private functions
    var initDatatable = function () {
        dt = $("#"+module+"_listing").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                // url: "https://preview.keenthemes.com/api/datatables.php",
                url: config.apiURL +'categories',

            },
            columns: [
                { data: 'id' },
                { data: 'category' },
                { data: 'certifications' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function (data) {

                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="rec-checkbox form-check-input" type="checkbox" value="${data}" />
                            </div>`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {

                         return `${row.category}`;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, row) {

                         return `<a href="${config.adminURL}category/${row.id}/certifications"><i class="fa-solid fa-list-check text-dark"></i> Certifications (${row.certifications_count})</a>`;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {

                        var editHtml = '';
                        var deleteHtml = '';

                        if(p.editCategory)
                        {
                            editHtml = `<div class="menu-item px-3">
                                    <a href="${config.adminURL}${module}/edit/${row.id}" class="menu-link px-3" data-kt-user-table-filter="edit_row">
                                        Edit
                                    </a>
                                </div>`;
                        }

                        if(p.deleteCategory)
                        {
                            deleteHtml = `<div class="menu-item px-3">
                                    <a href="javascript:void(0);" data-id="${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="delete_row">
                                        Delete
                                    </a>
                                </div>`;
                        }

                        return `
                            <a href="javascript:void(0);" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                ${editHtml}
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                ${deleteHtml}
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
            ],
            // Add data-filter attribute
            // createdRow: function (row, data, dataIndex) {
            //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            // }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-'+module+'-table-filter="search"]');

        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    // var handleFilterDatatable = () => {
    //     // Select filter options
    //     filterPayment = document.querySelectorAll('[data-kt-user-table-filter="payment_type"] [name="payment_type"]');
    //     const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');

    //     // Filter datatable on submit
    //     filterButton.addEventListener('click', function () {
    //         // Get filter values
    //         let paymentValue = '';

    //         // Get payment value
    //         filterPayment.forEach(r => {
    //             if (r.checked) {
    //                 paymentValue = r.value;
    //             }

    //             // Reset payment value if "All" is selected
    //             if (paymentValue === 'all') {
    //                 paymentValue = '';
    //             }
    //         });

    //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         dt.search(paymentValue).draw();
    //     });
    // }

    // Delete customer
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-'+module+'-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const recName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + recName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                            deleteData($(e.target).data('id'), dt);

                    } 
                });
            })
        });
    }

    var deleteData = (id, dt) => {

        $.ajax({
            type: 'DELETE',
            url: config.apiURL + module ,
            dataType:"JSON",
            data: {id: id},
            beforeSend:function(){


            },
            success:function(data){

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    dt.draw();
                });


            },
            error:function(xhr, ajaxOptions, thrownError){
                //parseErrors(xhr.responseText, globalFormId + '-msg')
            }
        });        

    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-'+module+'-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Reset payment type
            filterPayment[0].checked = true;

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            dt.search('').draw();
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#'+module+'_listing');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-'+module+'-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {

            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete selected records?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                },
            }).then(function (result) {
                if (result.value) {
                    // Simulate delete request -- for demo purpose only

                        let ids = [];
                        $(".rec-checkbox:checked").each(function() {
                            ids.push(this.value);
                        });                        

                        deleteData(ids, dt);

                        // Swal.fire({
                        //     text: "You have deleted all selected records!.",
                        //     icon: "success",
                        //     buttonsStyling: false,
                        //     confirmButtonText: "Ok, got it!",
                        //     customClass: {
                        //         confirmButton: "btn fw-bold btn-primary",
                        //     }
                        // }).then(function () {
                        //     // delete row data from server and re-draw datatable
                        //     dt.draw();
                        // });

                        // Remove header checked box
                        const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;

                }
            });
        });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#'+module+'_listing');
        const toolbarBase = document.querySelector('[data-kt-'+module+'-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-'+module+'-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-'+module+'-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Public methods
    return {
        init: function () {

            initDatatable();
            handleSearchDatatable();
            initToggleToolbar();
            //handleFilterDatatable();
            handleDeleteRows();
            handleResetForm();
        }
    }
}();


var getClientListing = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var module = $('.module').data('module');

    // Private functions
    var initDatatable = function () {
        dt = $("#"+module+"_listing").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                // url: "https://preview.keenthemes.com/api/datatables.php",
                url: config.apiURL +'clients',

            },
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'contact_email' },
                { data: 'contact_name' },
                { data: 'contact_person' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function (data) {

                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="rec-checkbox form-check-input" type="checkbox" value="${data}" />
                            </div>`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {

                         return `${row.name}`;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, row) {

                         return `${row.contact_email}`;
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, row) {

                         return `${row.contact_name}`;
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, row) {

                         return `${row.contact_number}`;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {

                        var editHtml = '';
                        var deleteHtml = '';

                        if(p.editCategory)
                        {
                            editHtml = `<div class="menu-item px-3">
                                    <a href="${config.adminURL}${module}/edit/${row.id}" class="menu-link px-3" data-kt-user-table-filter="edit_row">
                                        Edit
                                    </a>
                                </div>`;
                        }

                        if(p.deleteCategory)
                        {
                            deleteHtml = `<div class="menu-item px-3">
                                    <a href="javascript:void(0);" data-id="${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="delete_row">
                                        Delete
                                    </a>
                                </div>`;
                        }

                        return `
                            <a href="javascript:void(0);" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                ${editHtml}
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                ${deleteHtml}
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
            ],
            // Add data-filter attribute
            // createdRow: function (row, data, dataIndex) {
            //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            // }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-'+module+'-table-filter="search"]');

        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    // var handleFilterDatatable = () => {
    //     // Select filter options
    //     filterPayment = document.querySelectorAll('[data-kt-user-table-filter="payment_type"] [name="payment_type"]');
    //     const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');

    //     // Filter datatable on submit
    //     filterButton.addEventListener('click', function () {
    //         // Get filter values
    //         let paymentValue = '';

    //         // Get payment value
    //         filterPayment.forEach(r => {
    //             if (r.checked) {
    //                 paymentValue = r.value;
    //             }

    //             // Reset payment value if "All" is selected
    //             if (paymentValue === 'all') {
    //                 paymentValue = '';
    //             }
    //         });

    //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         dt.search(paymentValue).draw();
    //     });
    // }

    // Delete customer
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-'+module+'-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const recName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + recName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                            deleteData($(e.target).data('id'), dt);

                    } 
                });
            })
        });
    }

    var deleteData = (id, dt) => {

        $.ajax({
            type: 'DELETE',
            url: config.apiURL + module ,
            dataType:"JSON",
            data: {id: id},
            beforeSend:function(){


            },
            success:function(data){

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    dt.draw();
                });


            },
            error:function(xhr, ajaxOptions, thrownError){
                //parseErrors(xhr.responseText, globalFormId + '-msg')
            }
        });        

    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-'+module+'-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Reset payment type
            filterPayment[0].checked = true;

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            dt.search('').draw();
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#'+module+'_listing');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-'+module+'-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {

            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete selected records?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                },
            }).then(function (result) {
                if (result.value) {
                    // Simulate delete request -- for demo purpose only

                        let ids = [];
                        $(".rec-checkbox:checked").each(function() {
                            ids.push(this.value);
                        });                        

                        deleteData(ids, dt);

                        // Swal.fire({
                        //     text: "You have deleted all selected records!.",
                        //     icon: "success",
                        //     buttonsStyling: false,
                        //     confirmButtonText: "Ok, got it!",
                        //     customClass: {
                        //         confirmButton: "btn fw-bold btn-primary",
                        //     }
                        // }).then(function () {
                        //     // delete row data from server and re-draw datatable
                        //     dt.draw();
                        // });

                        // Remove header checked box
                        const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;

                }
            });
        });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#'+module+'_listing');
        const toolbarBase = document.querySelector('[data-kt-'+module+'-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-'+module+'-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-'+module+'-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Public methods
    return {
        init: function () {

            initDatatable();
            handleSearchDatatable();
            initToggleToolbar();
            //handleFilterDatatable();
            handleDeleteRows();
            handleResetForm();
        }
    }
}();

var getPeopleExpiredDocuments = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var module = $('.module').data('module');

    // Private functions
    var initDatatable = function () {
        dt = $("#people_expired_listing").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                // url: "https://preview.keenthemes.com/api/datatables.php",
                url: config.apiURL +'people/documents/expired',

            },
            columns: [
                { data: 'name' },
                { data: 'skill' },
                { data: 'expire_at' },
                { data: 'training' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function (data, type, row) {
                         return `${row.people.first_name} ${row.people.last_name}`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {
                        var training = '';
                        if(row.training != null)
                            training = 'Training';

                         return `<table><tr><td><span class="me-4 w-25px status-${row.status}${training}"></span></td><td>${row.skill.certification}</td><table>`;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, row) {

                         return `${moment(row.expire_at).format('DD/MM/YYYY')}`;
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, row) {

                        if(row.training != null)
                         return `<a href="${config.adminURL}training/pdf/${row.training.id}" class="menu-link px-3">${row.training.course_date}</a>`;
                        else
                            return ``;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {

                        var editHtml = '';
                        var deleteHtml = '';
                        var addTraining = '';

                        // if(p.editCategory)
                        // {
                        //     editHtml = `<div class="menu-item px-3">
                        //             <a href="${config.adminURL}${module}/edit/${row.id}" class="menu-link px-3" data-kt-user-table-filter="edit_row">
                        //                 Edit
                        //             </a>
                        //         </div>`;
                        // }

                        if(row.training == null)
                        {
                            addTraining = `<div class="menu-item px-3">
                                    <a href="javascript:void(0);"  onclick="getPeopleTraining(${row.people_id},${row.doc_class});" class="menu-link px-3">
                                        Add Training
                                    </a>
                                </div>`;
                        }

                        if(p.deleteCategory)
                        {
                            deleteHtml = `<div class="menu-item px-3">
                                    <a href="javascript:void(0);" data-id="${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="delete_row">
                                        Delete
                                    </a>
                                </div>`;
                        }

                        return `
                            <a href="javascript:void(0);" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                ${addTraining}
                                ${editHtml}
                                ${deleteHtml}
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
            ],
            // Add data-filter attribute
            // createdRow: function (row, data, dataIndex) {
            //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            // }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            // initToggleToolbar();
            // toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-'+module+'-table-filter="search"]');

        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    // var handleFilterDatatable = () => {
    //     // Select filter options
    //     filterPayment = document.querySelectorAll('[data-kt-user-table-filter="payment_type"] [name="payment_type"]');
    //     const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');

    //     // Filter datatable on submit
    //     filterButton.addEventListener('click', function () {
    //         // Get filter values
    //         let paymentValue = '';

    //         // Get payment value
    //         filterPayment.forEach(r => {
    //             if (r.checked) {
    //                 paymentValue = r.value;
    //             }

    //             // Reset payment value if "All" is selected
    //             if (paymentValue === 'all') {
    //                 paymentValue = '';
    //             }
    //         });

    //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         dt.search(paymentValue).draw();
    //     });
    // }

    // Delete customer
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-'+module+'-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const recName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + recName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                            deleteData($(e.target).data('id'), dt);

                    } 
                });
            })
        });
    }

    var deleteData = (id, dt) => {

        $.ajax({
            type: 'DELETE',
            url: config.apiURL + 'document/' + id ,
            dataType:"JSON",
            data: {id: id},
            beforeSend:function(){


            },
            success:function(data){

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    dt.draw();
                });


            },
            error:function(xhr, ajaxOptions, thrownError){
                //parseErrors(xhr.responseText, globalFormId + '-msg')
            }
        });        

    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-'+module+'-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Reset payment type
            filterPayment[0].checked = true;

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            dt.search('').draw();
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#'+module+'_listing');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-'+module+'-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {

            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete selected records?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                },
            }).then(function (result) {
                if (result.value) {
                    // Simulate delete request -- for demo purpose only

                        let ids = [];
                        $(".rec-checkbox:checked").each(function() {
                            ids.push(this.value);
                        });                        

                        deleteData(ids, dt);

                        // Swal.fire({
                        //     text: "You have deleted all selected records!.",
                        //     icon: "success",
                        //     buttonsStyling: false,
                        //     confirmButtonText: "Ok, got it!",
                        //     customClass: {
                        //         confirmButton: "btn fw-bold btn-primary",
                        //     }
                        // }).then(function () {
                        //     // delete row data from server and re-draw datatable
                        //     dt.draw();
                        // });

                        // Remove header checked box
                        const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;

                }
            });
        });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#'+module+'_listing');
        const toolbarBase = document.querySelector('[data-kt-'+module+'-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-'+module+'-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-'+module+'-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Public methods
    return {
        init: function () {

            initDatatable();
            handleSearchDatatable();
            // initToggleToolbar();
            //handleFilterDatatable();
            handleDeleteRows();
            handleResetForm();
        }
    }
}();

var getSuboperativeExpiredDocuments = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var module = 'subop';

    // Private functions
    var initDatatable = function () {
        dt = $("#suboperative_expired_listing").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                // url: "https://preview.keenthemes.com/api/datatables.php",
                url: config.apiURL +'suboperative/documents/expired',

            },
            columns: [
                { data: 'name' },
                { data: 'skill' },
                { data: 'expire_at' },
                { data: 'training' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function (data, type, row) {
                         return `${row.people.first_name} ${row.people.last_name}`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {

                         return `<table><tr><td><span class="me-4 w-25px status-${row.status}"></span></td><td>${row.skill.certification}</td><table>`;

                    }
                },
                {
                    targets: 2,
                    render: function (data, type, row) {

                         return `${moment(row.expire_at).format('DD/MM/YYYY')}`;
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, row) {

                        if(row.training != null)
                         return `${row.training.course_date}`;
                        else
                            return ``;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {

                        var editHtml = '';
                        var deleteHtml = '';

                        // if(p.editCategory)
                        // {
                        //     editHtml = `<div class="menu-item px-3">
                        //             <a href="${config.adminURL}${module}/edit/${row.id}" class="menu-link px-3" data-kt-user-table-filter="edit_row">
                        //                 Edit
                        //             </a>
                        //         </div>`;
                        // }

                        if(p.deleteCategory)
                        {
                            deleteHtml = `<div class="menu-item px-3">
                                    <a href="javascript:void(0);" data-id="${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="delete_row">
                                        Delete
                                    </a>
                                </div>`;
                        }

                        return `
                            <a href="javascript:void(0);" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                ${editHtml}
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                ${deleteHtml}
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
            ],
            // Add data-filter attribute
            // createdRow: function (row, data, dataIndex) {
            //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            // }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            // initToggleToolbar();
            // toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        // const filterSearch = document.querySelector('[data-kt-'+module+'-table-filter="search"]');

        // filterSearch.addEventListener('keyup', function (e) {
        //     dt.search(e.target.value).draw();
        // });
    }

    // Filter Datatable
    // var handleFilterDatatable = () => {
    //     // Select filter options
    //     filterPayment = document.querySelectorAll('[data-kt-user-table-filter="payment_type"] [name="payment_type"]');
    //     const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');

    //     // Filter datatable on submit
    //     filterButton.addEventListener('click', function () {
    //         // Get filter values
    //         let paymentValue = '';

    //         // Get payment value
    //         filterPayment.forEach(r => {
    //             if (r.checked) {
    //                 paymentValue = r.value;
    //             }

    //             // Reset payment value if "All" is selected
    //             if (paymentValue === 'all') {
    //                 paymentValue = '';
    //             }
    //         });

    //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         dt.search(paymentValue).draw();
    //     });
    // }

    // Delete customer
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-'+module+'-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const recName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + recName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                            deleteData($(e.target).data('id'), dt);

                    } 
                });
            })
        });
    }

    var deleteData = (id, dt) => {

        $.ajax({
            type: 'DELETE',
            url: config.apiURL + 'suboperative-document/' + id ,
            dataType:"JSON",
            data: {id: id},
            beforeSend:function(){


            },
            success:function(data){

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    dt.draw();
                });


            },
            error:function(xhr, ajaxOptions, thrownError){
                //parseErrors(xhr.responseText, globalFormId + '-msg')
            }
        });        

    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        // const resetButton = document.querySelector('[data-kt-'+module+'-table-filter="reset"]');

        // // Reset datatable
        // resetButton.addEventListener('click', function () {
        //     // Reset payment type
        //     filterPayment[0].checked = true;

        //     // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
        //     dt.search('').draw();
        // });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#'+module+'_listing');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-'+module+'-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {

            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete selected records?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                },
            }).then(function (result) {
                if (result.value) {
                    // Simulate delete request -- for demo purpose only

                        let ids = [];
                        $(".rec-checkbox:checked").each(function() {
                            ids.push(this.value);
                        });                        

                        deleteData(ids, dt);

                        // Swal.fire({
                        //     text: "You have deleted all selected records!.",
                        //     icon: "success",
                        //     buttonsStyling: false,
                        //     confirmButtonText: "Ok, got it!",
                        //     customClass: {
                        //         confirmButton: "btn fw-bold btn-primary",
                        //     }
                        // }).then(function () {
                        //     // delete row data from server and re-draw datatable
                        //     dt.draw();
                        // });

                        // Remove header checked box
                        const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;

                }
            });
        });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#'+module+'_listing');
        const toolbarBase = document.querySelector('[data-kt-'+module+'-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-'+module+'-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-'+module+'-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Public methods
    return {
        init: function () {

            initDatatable();
            handleSearchDatatable();
            // initToggleToolbar();
            //handleFilterDatatable();
            handleDeleteRows();
            handleResetForm();
        }
    }
}();


var getCertificationListing = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var module = $('.module').data('module');

    // Private functions
    var initDatatable = function () {
        dt = $("#"+module+"_listing").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                // url: "https://preview.keenthemes.com/api/datatables.php",
                url: config.apiURL +  module +'s' + '/' + $('#category_id').val(),

            },
            columns: [
                { data: 'id' },
                { data: 'certification' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function (data) {

                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="rec-checkbox form-check-input" type="checkbox" value="${data}" />
                            </div>`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {
                         return `${row.certification}`;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {

                        var editHtml = '';
                        var deleteHtml = '';

                        if(p.editCertification)
                        {
                            editHtml = `<div class="menu-item px-3">
                                    <a href="${config.adminURL}${module}/edit/${row.id}" class="menu-link px-3" data-kt-user-table-filter="edit_row">
                                        Edit
                                    </a>
                                </div>`;
                        }

                        if(p.deleteCertification)
                        {
                            deleteHtml = `<div class="menu-item px-3">
                                    <a href="javascript:void(0);" data-id="${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="delete_row">
                                        Delete
                                    </a>
                                </div>`;
                        }

                        return `
                            <a href="javascript:void(0);" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <!--end::Menu item-->
                                ${editHtml}
                                ${deleteHtml}
                                <!--begin::Menu item-->
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
            ],
            // Add data-filter attribute
            // createdRow: function (row, data, dataIndex) {
            //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            // }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-'+module+'-table-filter="search"]');

        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    // var handleFilterDatatable = () => {
    //     // Select filter options
    //     filterPayment = document.querySelectorAll('[data-kt-user-table-filter="payment_type"] [name="payment_type"]');
    //     const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');

    //     // Filter datatable on submit
    //     filterButton.addEventListener('click', function () {
    //         // Get filter values
    //         let paymentValue = '';

    //         // Get payment value
    //         filterPayment.forEach(r => {
    //             if (r.checked) {
    //                 paymentValue = r.value;
    //             }

    //             // Reset payment value if "All" is selected
    //             if (paymentValue === 'all') {
    //                 paymentValue = '';
    //             }
    //         });

    //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         dt.search(paymentValue).draw();
    //     });
    // }

    // Delete customer
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-'+module+'-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const recName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + recName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                            deleteData($(e.target).data('id'), dt);

                    } 
                });
            })
        });
    }

    var deleteData = (id, dt) => {

        $.ajax({
            type: 'DELETE',
            url: config.apiURL + module ,
            dataType:"JSON",
            data: {id: id},
            beforeSend:function(){


            },
            success:function(data){

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    dt.draw();
                });


            },
            error:function(xhr, ajaxOptions, thrownError){
                //parseErrors(xhr.responseText, globalFormId + '-msg')
            }
        });        

    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-'+module+'-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Reset payment type
            filterPayment[0].checked = true;

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            dt.search('').draw();
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#'+module+'_listing');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-'+module+'-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {

            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete selected records?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                },
            }).then(function (result) {
                if (result.value) {
                    // Simulate delete request -- for demo purpose only

                        let ids = [];
                        $(".rec-checkbox:checked").each(function() {
                            ids.push(this.value);
                        });                        

                        deleteData(ids, dt);

                        // Swal.fire({
                        //     text: "You have deleted all selected records!.",
                        //     icon: "success",
                        //     buttonsStyling: false,
                        //     confirmButtonText: "Ok, got it!",
                        //     customClass: {
                        //         confirmButton: "btn fw-bold btn-primary",
                        //     }
                        // }).then(function () {
                        //     // delete row data from server and re-draw datatable
                        //     dt.draw();
                        // });

                        // Remove header checked box
                        const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;

                }
            });
        });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#'+module+'_listing');
        const toolbarBase = document.querySelector('[data-kt-'+module+'-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-'+module+'-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-'+module+'-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Public methods
    return {
        init: function () {

            initDatatable();
            handleSearchDatatable();
            initToggleToolbar();
            //handleFilterDatatable();
            handleDeleteRows();
            handleResetForm();
        }
    }
}();

function addUpdateCategory()
{

    $.ajax({
        type: getMethod(),
        url: config.apiURL + 'category' + route() ,
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){

            showNotif(globalFormId + '-msg', data.message, 'success');
            window.location = config.adminURL + 'categories/';            

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}

function addUpdateClient()
{

    $.ajax({
        type: getMethod(),
        url: config.apiURL + 'client' + route() ,
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){

            showNotif(globalFormId + '-msg', data.message, 'success');
            window.location = config.adminURL + 'clients/';            

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}

function addUpdateCertification()
{

    $.ajax({
        type: getMethod(),
        url: config.apiURL + 'certification' + route() ,
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){

            showNotif(globalFormId + '-msg', data.message, 'success');
            window.location = config.adminURL + 'category/' +$('#category_id').val() + '/certifications';

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}


function getDocClasses(obj)
{

    $('select[name="cat_id[]"]').each(function(index) {
        var value = $(this).val();
        if(value != obj.value)
        {
            $(this).val(obj.value);
            $(this).trigger('change');
        }
    });



    $.ajax({
      type: 'GET',
      url: config.apiURL + 'certifications/' + obj.value,
      dataType:"JSON",
      data: {},
      beforeSend:function(){

      },
      success:function(data){
        if(data.status == 'success')
        {
            var optionsHtml = '<option value="">Select Certification</option>';
            $.each(data.data, function(index, value){
                optionsHtml += '<option value="'+value.id+'">'+value.certification+'</option>';
            });

            $(obj).parent().parent().parent().find('select[name^="doc_class"]').html(optionsHtml);

            $(obj).parent().parent().parent().find('select[name^="doc_class"]').select2("destroy");

            $(obj).parent().parent().parent().find('select[name^="doc_class"]').select2({
                placeholder: "Select Certification",
            });         

            if($('#skill').length > 0)
                $('#skill').html(optionsHtml);

            select2Patch('select[name^="doc_class"]', "#document_upload");

            



        }
      },
      error:function(xhr, ajaxOptions, thrownError){

      }
    });     
}





function searchPeople(skillChanges)
{

    if(!skillChanges &&  $('#name').val() != '')
    {
        $('#skill').val('').trigger('change');
    }
    else if(skillChanges)
    {
//        $('#name').val('');
    }

    $.ajax({
      type: 'GET',
      url: config.apiURL + 'people/search',
      dataType:"JSON",
      data: {"skill": $('#skill').val(),"name": $('#name').val(),"postcode": $('#postcode').val(),"status": $('#status').val()},
      beforeSend:function(){

      },
      success:function(data){
        var list = '';
        if(data.status == 'success')
        {
            var keywords_matched = '';
            var keywords_smiley = '';
            var keyword_status = '';







            if(typeof $('#skill').val() != "object" && $('#skill').val() != '')
            {
                keywords_matched = '<div class="col-md-12 kt-cen-brd">\
                                        '+ $('#skill .select2-selection__rendered').html() +'\
                                        </div>';

                keyword_status = '<div class="col-md-12 kt-cen-brd">\
                                            Status\
                                        </div>';
            }


            $.each(data.data, function(index, people){

                var drivingLicense = '';
                var skillBlock = '';

               


                if(typeof $('#skill').val() != "object" && $('#skill').val() != '')
                {
                    if(people.doc_status == 'Expiring')
                    {
                        skillBlock = '<span class="text-gray-800 fs-7 mb-1">Skill: <span class="badge badge-sm  badge-warning">Expiring</span></span>';
                    }
                    else if(people.doc_status == 'Critical')
                    {
                        skillBlock = '<span class="text-gray-800 fs-7 mb-1">Skill: <span class="badge badge-sm  badge-danger">Critical</span></span>';
                    }
                    else if(people.doc_status == 'Active')
                    {
                        skillBlock = '<span class="text-gray-800 fs-7 mb-1">Skill: <span class="badge badge-sm  badge-success">Valid</span></span>';
                    }
                }

                var availableFrom = '';

                if(people.available_from != '' && typeof people.available_from != 'object')
                {
                    availableFrom = '<span class="text-gray-800 fs-7 mb-1">Available: '+moment(people.available_from).format('DD/MM/YYYY')+'</span>';
                }

                var star = '';

                if(people.status == 'Active')
                    star += '<i class="fa-solid text-danger fs-8 fa-star"></i>';
                else
                    star += '<i class="fa-solid invisible text-danger  fs-8 fa-star"></i>';

                var miles = '';
                if(typeof people.miles != 'undefined' && people.miles != '')
                    miles = '<span class="text-gray-700 fs-9 mb-1">' + people.miles + 'miles</span>';

                var postcode = '';
                if(people.postcode != null)
                    postcode = `<div class="fw-semibold fs-7 text-muted"><i class="fas fa-map-marker-alt"></i> ${people.postcode}</div>`;


                list += `<div id="people-detail-${people.id}" onclick="getPeopleDetail(`+people.id+`);" class="d-flex flex-stack py-2" style="cursor:pointer;">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px symbol-circle">
                                        <img alt="Pic" src="${storageUrl}people-photos/${people.photo_path}" />
                                        <div href="#" class="like-button" title="Like Button">
                                            ${star}
                                          </div>
                                    </div>
                                    <div class="ms-5">
                                        <a href="javascript:void(0);"  class="fs-7 fw-bold text-gray-900 text-hover-primary mb-2">${people.first_name} ${people.last_name}</a>
                                        ${postcode}

                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
                                    ${drivingLicense}
                                    ${availableFrom}
                                    ${skillBlock}
                                    ${miles}
                                </div>
                                    

                            </div>`;














            //     list += `<div class="people-`+people.id+` kt-widget4__item" onclick="getPeopleDetail(`+people.id+`);">
            //                 <div class="kt-widget4__info">
            //                     <div class="kt-form kt-form--label-right kt-form-right-des">
            //                         <div class="col-md-2 text-center mb-2 kt-form-image">
            //                             <img style="width:50px !important;" src="`+config.webURL+`storage/misc_docs/`+people.photo_path+`" alt="">
            //                         </div>
            //                         <div class="form-group row mb-0 ck-form col-md-5 kt-form--field m-0 p-0 m-right">
            //                             <div class="col-md-12 kt-cen-brd">
            //                             `+people.first_name+' '+people.last_name+`
            //                             </div>
            //                             `+keywords_matched+`
            //                             <div class="col-md-12 kt-cen-brd">
            //                                 <i class="fa fa-map-marker-alt"></i> `+people.postcode+`
            //                             </div>
            //                         </div>
            //                         <div class="form-group row mb-0 ck-form col-md-2 kt-form--field m-0 p-0 m-right">
            //                             <div class="col-md-12 kt-cen-brd">
            //                             Available
            //                             </div>
            //                             `+keyword_status+`
            //                             <div class="col-md-12 kt-cen-brd">
            //                             D License

            //                             </div>
            //                         </div>

            //                         <div class="form-group row mb-0 ck-form col-md-3 kt-form--field m-0 p-0">
            //                             <div class="col-md-12 kt-cen-brd">
            //                                 `+moment(people.available_from).format('MM/DD/YYYY')+`
            //                             </div>
            //                             `+keywords_smiley+`
            //                             `+drivingLicense+`
            //                         </div>

            //                     </div>
            //                 </div>
            //             </div>`;

             });    



            if(list == '')
            {
                list = '<div class="no-result text-gray-700 fs-3">No people found with this search</div>';
                $('#people-detail').html('');
            }

            $('.people-list').html(list);

            $('.people-list .flex-stack:first-of-type').trigger('click');

        }

      },
      error:function(xhr, ajaxOptions, thrownError){
        ParseErrors(xhr.responseText, 'form', 'stickyHead');

      }
    });     
}



function getPeopleDetail(peopleId)
{
    $('div').removeClass('people-active');
    $('#people-detail-' + peopleId).addClass('people-active');

    $.ajax({
      type: 'GET',
      url: config.apiURL + 'people/' + peopleId,
      dataType:"JSON",
      data: {},
      beforeSend:function(){
      },
      success:function(data){
        if(data.status == 'success')
        {
            $('#people-detail').html(data.html);
            getDocuments();
            KTUppy.init('photo', 'Upload Photo');
            initRating();
            KTUppy.init('replace_dl', 'Upload Document');
            var validator = $("#dl_form").validate({
              submitHandler: function(form) {
                updateDl();
              }
             });

            $('#dl_expire').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
            });

            var validator = $("#people-form").validate({
              submitHandler: function(form) {
                updateNotesRating();
              }
             });


        }
      },
      error:function(xhr, ajaxOptions, thrownError){
        KTApp.unprogress(btn[0]);
        ParseErrors(xhr.responseText, 'form', 'stickyHead');

      }
    });     
}




function getDocuments()
{
    var suboperative = '';

    if($('#suboperative_form').length)
        suboperative = 'suboperative-';

    $.ajax({
      type: 'get',
      url: config.apiURL + suboperative + 'documents',
      dataType:"JSON",
      data: {id:$('#id').val(), rid:$('#rid').val()},
      beforeSend:function(){

      },
      success:function(data){
        if(data.status == 'success')
        {
            let html = '';
            var certs = '<option value="">Select Certification</option>';
            var assignSkills = '<option value="">Select Skill</option>';            
            if(data.documents.length > 0)
            {
                $.each(data.documents, function(index, doc){


                    var files = (doc.doc_path).split(',');
                    var filesHtml = '';
                    var checkedIcon = '';
                    var selected = '';
                    var editHtml = ``;
                    var deleteHtml = ``;
                    if(suboperative != '')
                    {
                        var userId = doc.suboperative_id;
                    }
                    else
                    {
                        var userId = doc.people_id;
                    }
                    if(p.viewPeopleDocument)
                    {

                        if(files.length > 1)
                        {
                            // filesHtml += '<button class="btn btn-primary view-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\
                            //                  View\
                            //              </button>\
                            //             <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                            $.each(files, function(index, file){
    //                          filesHtml += '<a class="dropdown-item" target="_blank" href="'+config.webURL+'storage/documents/'+file+'" data-toggle="kt-tooltip" title="Tooltip title" data-placement="left">File</a>';
                                
                                cls = '';

                                if(index != 0)
                                    cls = 'd-none';

                                filesHtml += '<a class="lightboxed badge badge-dark fs-base '+cls+'" rel="'+doc.batch+'-'+doc.id+'"  data-link="'+storageUrl + suboperative + 'documents/'+userId+'/'+file+'" class="btn btn-primary view-btn">View</button></a>';
                            });


                            // filesHtml += '</div>';




                        }
                        else
                        {
                            filesHtml = '<a class="lightboxed badge badge-dark fs-base" rel="'+doc.id+doc.batch+'"  data-link="'+storageUrl+suboperative+'documents/'+userId+'/'+doc.doc_path+'" class="btn btn-primary view-btn">View</button></a>';
                        }
                    }


                    var badge = '';
                    if(doc.status == 'Active')
                        badge = 'success';
                    else if(doc.status == 'Expiring')
                        badge = 'warning';
                    else if(doc.status == 'Critical')
                        badge = 'danger';


                    if(p.editPeopleDocument)
                        editHtml = `<i onclick="editDoc(${doc.id})" class="fs-8 me-3 d-block fas fa-pencil"></i>`;

                    if(p.deletePeopleDocument)                        
                        deleteHtml = `<i onclick="deleteDoc(${doc.id})" class="fs-8 me-3 d-block fas fa-trash"></i>`;

                    var training = '';
                    if(doc.training != null)
                        training = 'Training';

                    // html += `<div class="d-flex flex-stack">
                    //         <span class="me-4 w-25px status-${doc.status}${training}"></span>
                    //         <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                    //             <div class="me-5">
                    //                 <a href="javascript:void(0);" class="text-gray-800 fw-bold text-hover-primary fs-7"> ${doc.skill.certification} </a>
                    //                 <span class=" fw-semibold fs-7 d-block text-start ps-0">${moment(doc.expire_at).format('DD/MM/YYYY')}  </span>
                    //             </div>
                    //             <div class="d-flex align-items-center">
                    //                 ${editHtml}
                    //                 ${deleteHtml}
                    //                 <div class="m-0">
                    //                     ${filesHtml}
                    //                 </div>
                    //             </div>
                    //         </div>
                    //     </div>
                    //     <div class="separator separator-dashed my-3"></div>`;

                    if(doc.skill != null)
                    {
                        html += `<table><tr><td><span class="me-4 w-25px status-${doc.status}${training}"></span></td>
                                        <td style="width:240px;"> <a href="javascript:void(0);" class="text-gray-800 fw-bold text-hover-primary fs-7"> ${doc.skill.certification ?? ''} </a>
                                             <span class=" fw-semibold fs-7 d-block text-start ps-0">${moment(doc.expire_at).format('DD/MM/YYYY')}  </span></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                ${editHtml}
                                                ${deleteHtml}
                                                <div class="m-0">
                                                    ${filesHtml}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr><div class="separator separator-dashed my-3"></tr>
                                </table>`;

                        certs += `<option ${selected} value="${doc.id}">${doc.skill.certification}</option>`;

                        var hidden = '';
    

                        assignSkills += `<option data-status=${doc.status} value="${doc.id}">${doc.skill.certification}</option>`;
                    }



                    // html += '<tr class="ck-form">\
                    //         <td width="60%"><i class="fa fa-pencil-alt " onclick="editDoc('+doc.id+')"></i> '+doc.skill.doc_class+'</td>\
                    //         <td width="25%">'+doc.expire_at+'</td>\
                    //         <td class="status-'+doc.status+'" style="border-radius:0px;" width="2%">&nbsp;&nbsp;&nbsp;</td>\
                    //         <td>'+filesHtml+'</td>\
                    //     </tr>';
                });             

                
                $('#assign_doc_id').html(assignSkills);

                $('#certification_id').html(certs);

            }
            else
            {
                    html += '<tr><td class="fs-5 fw-semibold text-gray-600" colspan="4" align="center"><span style="margin-left:40px;">No documents uploaded yet</span></td></tr>';
            }

            $('#documents').html(html);

            // init lightbox
            jQuery( '.lightboxed' ).lightboxed(); 


        }
      },
      error:function(xhr, ajaxOptions, thrownError){
        ParseErrors(xhr.responseText, 'form', 'stickyHead');

      }
    });     
}

function addDoc(trainingId)
{
    initDatePicker("#replace_expire_at");
    $('#replace_expire_at').val('');
    $('#doc_id').val(0);
    $('#edit_doc_modal').modal('show');
    $('#training_id').val(trainingId);
    return false;    
}

function editDoc(docId) {

    var suboperative = '';

    if($('#suboperative_form').length)
        suboperative = 'suboperative-';


    $('#edit_doc_modal').modal('show');
    $.ajax({
      type: 'GET',
      url: config.apiURL + suboperative + 'document/' + docId,
      dataType:"JSON",
      data: {},
      beforeSend:function(){

      },
      success:function(data){

        if(data.status == 'success')
        {
            //$('#replace_doc_path').val(data.data.doc_path);
            initDatePicker("#replace_expire_at");
            $('#replace_expire_at').val(getDmy(data.data.expire_at));
            $('#doc_id').val(data.data.id);



        }
      },
      error:function(xhr, ajaxOptions, thrownError){
        ParseErrors(xhr.responseText, form, 'stickyHeader');

      }
    });
}


// set the dropzone container id


function initDZUploader(id, samename)
{
    if($(id).length == 0)
        return false;
    const dropzone = document.querySelector(id);
    origName = id;
    // set the preview element template
    var previewNode = dropzone.querySelector(".dropzone-item");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    var myDropzone = new Dropzone(id, { // Make the whole body a dropzone
        url: config.apiURL + 'media/upload?_token=' + $('meta[name="csrf-token"]').attr('content')+'&samename=' + samename  ,
        parallelUploads: 20,
        maxFilesize: 20, // Max filesize in MB
        previewTemplate: previewTemplate,
        previewsContainer: id + " .dropzone-items", // Define the container to display the previews
        clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.
    });

    myDropzone.on("addedfile", function (file) {
        // Hookup the start button
        const dropzoneItems = dropzone.querySelectorAll('.dropzone-item');
        dropzoneItems.forEach(dropzoneItem => {
            dropzoneItem.style.display = '';
        });
    });

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function (progress) {
        const progressBars = dropzone.querySelectorAll('.progress-bar');
        progressBars.forEach(progressBar => {
            progressBar.style.width = progress + "%";
        });
    });

    myDropzone.on("sending", function (file) {
        // Show the total progress bar when upload starts
        const progressBars = dropzone.querySelectorAll('.progress-bar');
        progressBars.forEach(progressBar => {
            progressBar.style.opacity = "1";
        });
    });

    // Hide the total progress bar when nothing"s uploading anymore
    myDropzone.on("complete", function (progress) {
        const progressBars = dropzone.querySelectorAll('.dz-complete');

        let fileJson = jQuery.parseJSON(progress.xhr.response);
        
        if(id == '#gross_status')
            $(id + '_path').val(fileJson.new);
        else
            $(id + '_path').val($(id + '_path').val() +','+fileJson.new);


        setTimeout(function () {
            progressBars.forEach(progressBar => {
                progressBar.querySelector('.progress-bar').style.opacity = "0";
                progressBar.querySelector('.progress').style.opacity = "0";
            });
        }, 300);
    });
}

function updateDocument()
{
    var suboperative = '';

    if($('#suboperative_form').length)
        suboperative = 'suboperative-';
    var trainingId = $('#training_id').val();


    $.ajax({
      type: 'PUT',
      url: config.apiURL + suboperative + 'document/' + $('#doc_id').val(),
      dataType:"JSON",
      data: $( globalFormId ).serialize() + '&training_id=' + trainingId,
      beforeSend:function(){

      },
      success:function(data){

        if(data.status == 'success')
        {

            $('#edit_doc_modal').modal('hide');
            getDocuments();

            // if on training page, reload.
            if($('.module').data('module') == 'training')
            {
                location.reload();
            }

        }
      },
      error:function(xhr, ajaxOptions, thrownError){
        ParseErrors(xhr.responseText, form, 'stickyHeader');

      }
    });
}


function addMoreHolidays()
{


        var html= `<div class="mw-300px">
                            <div class="d-flex flex-stack mb-3">
                                <input type="text" name="holiday_from[]" class="form-control smart-field" style="margin-right: 4px;" placeholder="Holiday Start">
                                <input type="text" name="holiday_to[]" class="form-control smart-field" placeholder="Holiday End" style="margin-right: 10px;">
                                <a onclick="removeHoliday(this);" href="javascript:void(0);"><i class="fa-solid fa-trash text-danger"></i></a>                                
                            </div>
                        </div>`;



        $( ".holidaysdiv" ).append( html );


        initDatePicker("[name^='holiday_from'], [name^='holiday_to']");


}

function showUpload()
{
    $('#document_upload').modal('show');
}

function removeHoliday(obj)
{
    $(obj).parent().parent().remove();
}

function removeBasicHoliday(obj)
{
    $(obj).parent().parent().find('input').val('');
    $(obj).remove();
}

function makeid(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * 
 charactersLength));
   }
   return result;
}

function addMoreDoc()
{
    var rndClass = makeid(10);

    html = `            <div class="row extended_doc ${rndClass} ">
                            <div class="col-xl-4 ">
                                <div class="mb-10  fv-plugins-icon-container">
                                    <label class="required fs-5 fw-semibold mb-2">Select Category</label>
                                    <select onchange="getDocClasses(this);" name="cat_id[]" class="form-select"  data-placeholder="Select an option">
                                        ${catOptions}
                                    </select>
                                </div>
                            </div>


                            <div class="col-xl-5">
                                <div class="mb-10 fv-plugins-icon-container">
                                    <label class="required fs-5 fw-semibold mb-2">Select Certification</label>
                                    <select name="doc_class[]" class="form-select" data-control="select2" data-placeholder="Select an option">
                                        <option value="">Select Certification</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-xl-2">
                                <div class="mb-10 fv-plugins-icon-container">
                                    <label class="required fs-5 fw-semibold mb-2">Expiry</label>
                                    <input type="text" class="form-control form-control-lg form-control-solid" style="padding: 7px;" name="expire_at[]" placeholder="">
                                </div>
                            </div>


                            <div class="col-xl-1">
                                <div class="mb-10 fv-plugins-icon-container">
                                    <label class="fs-5 fw-semibold mb-2"></label>

                                        <a onclick="removeDoc('${rndClass}')" href="javascript:void(0);"><i class="fa-solid fa-trash fs-1 text-danger" style="margin-top: 42px;"></i></a>


                                </div>
                            </div>



                        </div>`;




    $( '.extended-docs' ).append( html );


    var catId = $('select[name="cat_id[]"]').first().val();
    $('.' + rndClass + ' select[name="cat_id[]"]').val(catId);
    $('.' + rndClass + ' select[name="cat_id[]"]').trigger('change');


//  $( html ).insertAfter( ".add-doc-portlet" );

    initDatePicker("[name^='expire_at']");

    // $('input[name^=""]').datepicker({
    //     format: "yyyy-mm-dd",
    //     autoclose: true,
    // });

    $('.' + rndClass).find('select[name^="cat_id"]').select2({
        placeholder: "Select Certification",
    });         

    $('.' + rndClass).find('select[name^="doc_class"]').select2({
        placeholder: "Select Certification",
    });         


}




function addUpdatePeople(obj)
{
    // var form = $( globalFormId );
   var formData = new FormData(obj);

    $.ajax({
      type: 'POST',
        processData: false,
        contentType: false,
        cache: false,
      url: config.apiURL + 'people',
      dataType:"JSON",
//      data: $( globalFormId ).serialize(),
     data:  formData,
    enctype: 'multipart/form-data',

      beforeSend:function(){

      },
      success:function(data){

        if(data.status == 'success')
        {
            window.onbeforeunload = function () {
            }

            var action = $('#id').val() != '' ? 'update' : 'save';

            window.location = config.adminURL + 'people/edit/' + data.id + '?resp=' + action;

        }
        else if(data.status == 'error')
        {

            Swal.fire({
                text: data.message,
                icon: "warning",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn fw-bold btn-primary",
                }
            });

        }

      },
      error:function(xhr, ajaxOptions, thrownError){
        // KTApp.unprogress(btn[0]);
            parseErrors(xhr.responseText, globalFormId + '-msg')
      }
    });     
}

function addDocumentBK()
{
    var btn = $('.add-document');

    var expire_at = $('input[name^="expire_at"]').serialize();
    var doc_class = $('select[name^="doc_class"]').serialize();


    $.ajax({
      type: 'POST',
      url: config.apiURL + 'document?' + expire_at + '&' + doc_class,
      dataType:"JSON",
      data: {"document_path": $('#document_path').val(),"id": $('#id').val(),"rid": $('#rid').val()},
      beforeSend:function(){
        KTApp.progress(btn[0]);
      },
      success:function(data){
        KTApp.unprogress(btn[0]);
        if(data.status == 'success')
        {

            $('select[name^="cat_id"], input[name^="expire_at"], #document_path').val('');

            $('select[name^="doc_class"]').val('').trigger('change') ;

            $("#document .kt-uppy__list-remove").val('').trigger('click') ;
            $('.extended_doc').remove();
            getDocuments();
        }
      },
      error:function(xhr, ajaxOptions, thrownError){
        KTApp.unprogress(btn[0]);
        ParseErrors(xhr.responseText, 'form', 'stickyHead');

      }
    });     
}



function addDocuments()
{
    var suboperative = '';

    if($('#suboperative_form').length)
        suboperative = 'suboperative-';

    $.ajax({
      type: 'POST',
      url: config.apiURL + suboperative+'document/upload?id='+$('#id').val()+'&rid=' +$('#rid').val(),
      dataType:"JSON",
      data: $( globalFormId ).serialize(),
      beforeSend:function(){

      },
      success:function(data){

        if(data.status == 'success')
        {

            $('select[name^="cat_id"], input[name^="expire_at"], #document_path').val('');

            $('select[name^="doc_class"]').val('').trigger('change') ;

            $('.extended_doc').remove();

            $('#document_upload').modal('hide');

            getDocuments();


            //remove file from dropzone
            $('#docfiles .dropzone-items').html('');
            $('#docfiles #docfiles_path').val('');



        }
        else
        {
            Swal.fire({
                text: data.message,
                icon: "warning",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn fw-bold btn-primary",
                }
            });

        }

      },
      error:function(xhr, ajaxOptions, thrownError){

            parseErrors(xhr.responseText, globalFormId + '-msg')

      }
    });
}



function addContact()
{
    var html = `<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">

                            <div class="col-xl-3">
                                <div class="fv-row mb-4">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Name</span>
                                    </label>
                                    <input type="text" name="name[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Name" value="" />
                                </div>
                            </div>

                            <div class="col-xl-2">
                                <div class="fv-row mb-4">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Mobile</span>
                                    </label>
                                    <input type="text" name="mobile[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Mobile" value="" />
                                </div>
                            </div>

                            <div class="col-xl-3">
                                <div class="fv-row mb-4">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Email</span>
                                    </label>
                                    <input type="text" name="email[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Email" value="" />
                                </div>
                            </div>

                            <div class="col-xl-3">
                                <div class="fv-row mb-4">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Position</span>
                                    </label>
                                    <input type="text" name="position[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Position" value="" />
                                </div>
                            </div>

                            <div class="col-xl-1">
                                <div class="fv-row mb-4">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                    </label>
                                    <a onclick="removeContact(this);" href="javascript:void(0);"><i class="fa-solid fa-trash fs-1 text-danger" style="margin-top: 42px;"></i></a>
                                </div>
                            </div>
                        </div>`;


    $( html ).insertAfter( ".primary-contact" );


}

function removeContact(obj)
{
    $(obj).parent().parent().parent().remove();
}


function addLink()
{
    var html = `<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">

                            <div class="col-xl-3">
                                <div class="fv-row mb-4">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Title</span>
                                    </label>
                                    <input type="text" name="title[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Title" value="" />
                                </div>
                            </div>

                            <div class="col-xl-8">
                                <div class="fv-row mb-4">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Link</span>
                                    </label>
                                    <input type="text" name="link[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Link" value="" />
                                </div>
                            </div>

                         
                            <div class="col-xl-1">
                                <div class="fv-row mb-4">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                    </label>
                                    <a onclick="removeLink(this);" href="javascript:void(0);"><i class="fa-solid fa-trash fs-1 text-danger" style="margin-top: 42px;"></i></a>
                                </div>
                            </div>
                        </div>`;


    $( html ).insertAfter( ".primary-link" );


}

function removeLink(obj)
{
    $(obj).parent().parent().parent().remove();
}


function addUpdateSite()
{

    $.ajax({
        type: getMethod(),
        url: config.apiURL + 'site' + route() ,
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){

            showNotif(globalFormId + '-msg', data.message, 'success');
            window.location = config.adminURL + 'sites';            

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}

function addUpdateSubcontractor()
{

    $.ajax({
        type: getMethod(),
        url: config.apiURL + 'subcontractor' + route() ,
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){

            showNotif(globalFormId + '-msg', data.message, 'success');
            window.location = config.adminURL + 'subcontractors';            

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}


var getSiteListing = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var module = $('.module').data('module');

    // Private functions
    var initDatatable = function () {
        dt = $("#"+module+"_listing").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                // url: "https://preview.keenthemes.com/api/datatables.php",
                url: config.apiURL + module +'s',

            },
            columns: [
                { data: 'id' },
                { data: 'site' },
                { data: 'address' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function (data) {

                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="rec-checkbox form-check-input" type="checkbox" value="${data}" />
                            </div>`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {
                         return `${row.site}`;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, row) {
                         return `${row.address}`;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {

                        var editHtml = '';
                        var deleteHtml = '';

                        if(p.editSite)
                        {
                            editHtml = `<div class="menu-item px-3">
                                    <a href="${config.adminURL}${module}/edit/${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="edit_row">
                                        Edit
                                    </a>
                                </div>`;
                        }

                        if(p.deleteSite)
                        {
                            deleteHtml = `<div class="menu-item px-3">
                                    <a href="#" data-id="${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="delete_row">
                                        Delete
                                    </a>
                                </div>`;
                        }

                        return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                ${editHtml}
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                ${deleteHtml}
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
            ],
            // Add data-filter attribute
            // createdRow: function (row, data, dataIndex) {
            //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            // }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-'+module+'-table-filter="search"]');

        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    // var handleFilterDatatable = () => {
    //     // Select filter options
    //     filterPayment = document.querySelectorAll('[data-kt-user-table-filter="payment_type"] [name="payment_type"]');
    //     const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');

    //     // Filter datatable on submit
    //     filterButton.addEventListener('click', function () {
    //         // Get filter values
    //         let paymentValue = '';

    //         // Get payment value
    //         filterPayment.forEach(r => {
    //             if (r.checked) {
    //                 paymentValue = r.value;
    //             }

    //             // Reset payment value if "All" is selected
    //             if (paymentValue === 'all') {
    //                 paymentValue = '';
    //             }
    //         });

    //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         dt.search(paymentValue).draw();
    //     });
    // }

    // Delete customer
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-'+module+'-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const recName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + recName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                            deleteData($(e.target).data('id'), dt);

                    } 
                });
            })
        });
    }

    var deleteData = (id, dt) => {

        $.ajax({
            type: 'DELETE',
            url: config.apiURL + module ,
            dataType:"JSON",
            data: {id: id},
            beforeSend:function(){


            },
            success:function(data){

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    dt.draw();
                });


            },
            error:function(xhr, ajaxOptions, thrownError){
                //parseErrors(xhr.responseText, globalFormId + '-msg')
            }
        });        

    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-'+module+'-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Reset payment type
            filterPayment[0].checked = true;

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            dt.search('').draw();
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#'+module+'_listing');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-'+module+'-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {

            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete selected records?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                },
            }).then(function (result) {
                if (result.value) {
                    // Simulate delete request -- for demo purpose only

                        let ids = [];
                        $(".rec-checkbox:checked").each(function() {
                            ids.push(this.value);
                        });                        

                        deleteData(ids, dt);

                        // Swal.fire({
                        //     text: "You have deleted all selected records!.",
                        //     icon: "success",
                        //     buttonsStyling: false,
                        //     confirmButtonText: "Ok, got it!",
                        //     customClass: {
                        //         confirmButton: "btn fw-bold btn-primary",
                        //     }
                        // }).then(function () {
                        //     // delete row data from server and re-draw datatable
                        //     dt.draw();
                        // });

                        // Remove header checked box
                        const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;

                }
            });
        });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#'+module+'_listing');
        const toolbarBase = document.querySelector('[data-kt-'+module+'-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-'+module+'-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-'+module+'-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Public methods
    return {
        init: function () {

            initDatatable();
            handleSearchDatatable();
            initToggleToolbar();
            //handleFilterDatatable();
            handleDeleteRows();
            handleResetForm();
        }
    }
}();


function searchSite()
{
    $.ajax({
      type: 'GET',
      url: config.apiURL + 'sites',
      dataType:"JSON",
      data: {search_term: $('#site_search').val(), "nopage": 1},
      beforeSend:function(){

      },
      success:function(data){
        if(data.status == 'success')
        {
            var html = '';
            if(data.data.length > 0)
            {
                $.each(data.data, function(index, site){
                    html += `       <div id="site-detail-${site.id}" class="d-flex flex-stack py-4" onclick="getSiteDetail(${site.id});">
                                        <div class="d-flex align-items-center">
                                            <div class="ms-5">
                                                <a href="javascript:void(0);" class="fs-5 fw-bold text-gray-900 mb-2">${site.site}</a>
                                                <div class="fw-semibold text-muted"><i class="fas fa-map-marker-alt"></i> ${site.address}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="separator separator-dashed "></div>`;
                });                
            }
            else
            {
                html = '<div class="no-result text-gray-700 fs-3">No sites found</div>';
            }

            $('.site-list').html(html);


        }
      },
      error:function(xhr, ajaxOptions, thrownError){

      }
    });     
}

function getSiteDetail(siteId)
{
    $('div').removeClass('people-active');
    $('#site-detail-' + siteId).addClass('people-active');

    $.ajax({
      type: 'GET',
      url: config.apiURL + 'site/' + siteId,
      dataType:"JSON",
      data: {},
      beforeSend:function(){
      },
      success:function(data){
        if(data.status == 'success')
        {

            $('#site-detail').html(data.html);


        }
      },
      error:function(xhr, ajaxOptions, thrownError){
        KTApp.unprogress(btn[0]);
        ParseErrors(xhr.responseText, 'form', 'stickyHead');

      }
    });     
}


function removeDoc(obj)
{
    $('.' + obj + ' .col-xl-4, '+'.' + obj + ' .col-xl-5'+', '+ '.'+ obj + ' .col-xl-2').remove();
    $('.' + obj).hide();   
}


function deleteDoc(docId)
{
    Swal.fire({
        text: "Are you sure you want to delete this document?",
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Yes, delete!",
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    }).then(function (result) {
        if (result.value) {
            // Simulate delete request -- for demo purpose only


            var suboperative = '';

            if($('#suboperative_form').length)
                suboperative = 'suboperative-';

            $.ajax({
                type: 'DELETE',
                url: config.apiURL + suboperative + 'document/' + docId ,
                dataType:"JSON",
                data: {},
                beforeSend:function(){


                },
                success:function(data){

                    Swal.fire({
                        text: data.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    }).then(function () {
                        getDocuments();
                    });


                },
                error:function(xhr, ajaxOptions, thrownError){
                    //parseErrors(xhr.responseText, globalFormId + '-msg')
                }
            });    


        } 
    });
}

function deletePeople(peopleId)
{
    Swal.fire({
        text: "Are you sure you want to delete this?",
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Yes, delete!",
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    }).then(function (result) {
        if (result.value) {
            // Simulate delete request -- for demo purpose only



            $.ajax({
                type: 'DELETE',
                url: config.apiURL + 'people',
                dataType:"JSON",
                data: {id: peopleId},
                beforeSend:function(){


                },
                success:function(data){

                    Swal.fire({
                        text: data.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    }).then(function () {
                        if($('#banned_listing').length)
                        {
                            $('#banned_listing').DataTable().clear().destroy();
                            getBannedListing.init();

                        }
                        if($('#deactivated_listing').length)
                        {
                            $('#deactivated_listing').DataTable().clear().destroy();
                            getDeactivatedListing.init();

                        }
                        else
                            searchPeople();
                    });


                },
                error:function(xhr, ajaxOptions, thrownError){
                    //parseErrors(xhr.responseText, globalFormId + '-msg')
                }
            });    


        } 
    });
}

var getSubcontractorListing = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var module = $('.module').data('module');

    // Private functions
    var initDatatable = function () {
        dt = $("#"+module+"_listing").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                // url: "https://preview.keenthemes.com/api/datatables.php",
                url: config.apiURL + module +'s',

            },
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'Suboperative' },
                { data: 'Teams' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function (data) {

                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="rec-checkbox form-check-input" type="checkbox" value="${data}" />
                            </div>`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {
                         return `<a href="${config.adminURL}${module}/view/${row.id}">${row.name}</a>`;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, row) {
                        if(p.viewSuboperatives)
                            return `<a href="${config.adminURL}subcontractor/${row.id}/suboperatives"><i class="fa-solid fa-users text-dark"></i> Suboperatives</a>`;
                        else
                            return `No Access`;
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, row) {
                        if(p.viewTeam)
                            return `<a href="${config.adminURL}teams/?subcontractor_id=${row.id}"><i class="fa-solid fa-list-check text-dark"></i> Teams</a>`;
                        else
                            return `No Access`;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {


                        var editHtml = '';
                        var deleteHtml = '';

                        if(p.editSubcontractor)
                        {
                            editHtml = `<div class="menu-item px-3">
                                    <a href="${config.adminURL}${module}/edit/${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="edit_row">
                                        Edit
                                    </a>
                                </div>`;
                        }

                        if(p.deleteSubcontractor)
                        {
                            deleteHtml = `<div class="menu-item px-3">
                                    <a href="#" data-id="${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="delete_row">
                                        Delete
                                    </a>
                                </div>`;
                        }

                        return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                ${editHtml}
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                ${deleteHtml}
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
            ],
            // Add data-filter attribute
            // createdRow: function (row, data, dataIndex) {
            //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            // }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-'+module+'-table-filter="search"]');

        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    // var handleFilterDatatable = () => {
    //     // Select filter options
    //     filterPayment = document.querySelectorAll('[data-kt-user-table-filter="payment_type"] [name="payment_type"]');
    //     const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');

    //     // Filter datatable on submit
    //     filterButton.addEventListener('click', function () {
    //         // Get filter values
    //         let paymentValue = '';

    //         // Get payment value
    //         filterPayment.forEach(r => {
    //             if (r.checked) {
    //                 paymentValue = r.value;
    //             }

    //             // Reset payment value if "All" is selected
    //             if (paymentValue === 'all') {
    //                 paymentValue = '';
    //             }
    //         });

    //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         dt.search(paymentValue).draw();
    //     });
    // }

    // Delete customer
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-'+module+'-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const recName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + recName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                            deleteData($(e.target).data('id'), dt);

                    } 
                });
            })
        });
    }

    var deleteData = (id, dt) => {

        $.ajax({
            type: 'DELETE',
            url: config.apiURL + module ,
            dataType:"JSON",
            data: {id: id},
            beforeSend:function(){


            },
            success:function(data){

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    dt.draw();
                });


            },
            error:function(xhr, ajaxOptions, thrownError){
                //parseErrors(xhr.responseText, globalFormId + '-msg')
            }
        });        

    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-'+module+'-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Reset payment type
            filterPayment[0].checked = true;

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            dt.search('').draw();
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#'+module+'_listing');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-'+module+'-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {

            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete selected records?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                },
            }).then(function (result) {
                if (result.value) {
                    // Simulate delete request -- for demo purpose only

                        let ids = [];
                        $(".rec-checkbox:checked").each(function() {
                            ids.push(this.value);
                        });                        

                        deleteData(ids, dt);

                        // Swal.fire({
                        //     text: "You have deleted all selected records!.",
                        //     icon: "success",
                        //     buttonsStyling: false,
                        //     confirmButtonText: "Ok, got it!",
                        //     customClass: {
                        //         confirmButton: "btn fw-bold btn-primary",
                        //     }
                        // }).then(function () {
                        //     // delete row data from server and re-draw datatable
                        //     dt.draw();
                        // });

                        // Remove header checked box
                        const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;

                }
            });
        });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#'+module+'_listing');
        const toolbarBase = document.querySelector('[data-kt-'+module+'-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-'+module+'-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-'+module+'-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Public methods
    return {
        init: function () {

            initDatatable();
            handleSearchDatatable();
            initToggleToolbar();
            //handleFilterDatatable();
            handleDeleteRows();
            handleResetForm();
        }
    }
}();


var getTeamListing = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var module = $('.module').data('module');

    // Private functions
    var initDatatable = function () {
        dt = $("#"+module+"_listing").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                // url: "https://preview.keenthemes.com/api/datatables.php",
                url: config.apiURL +  module +'s' + '/' + $('#subcontractor_id').val(),

            },
            columns: [
                { data: 'id' },
                { data: 'team' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function (data) {

                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="rec-checkbox form-check-input" type="checkbox" value="${data}" />
                            </div>`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {
                         return `${row.team}`;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {

                        var editHtml = '';
                        var deleteHtml = '';

                        if(p.editTeam)
                        {
                            editHtml = `<div class="menu-item px-3">
                                    <a href="${config.adminURL}${module}/edit/${row.id}" class="menu-link px-3" data-kt-user-table-filter="edit_row">
                                        Edit
                                    </a>
                                </div>`;
                        }

                        if(p.deleteTeam)
                        {
                            deleteHtml = `<div class="menu-item px-3">
                                    <a href="javascript:void(0);" data-id="${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="delete_row">
                                        Delete
                                    </a>
                                </div>`;
                        }

                        return `
                            <a href="javascript:void(0);" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <!--end::Menu item-->
                                ${editHtml}
                                ${deleteHtml}
                                <!--begin::Menu item-->
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
            ],
            // Add data-filter attribute
            // createdRow: function (row, data, dataIndex) {
            //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            // }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-'+module+'-table-filter="search"]');

        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    // var handleFilterDatatable = () => {
    //     // Select filter options
    //     filterPayment = document.querySelectorAll('[data-kt-user-table-filter="payment_type"] [name="payment_type"]');
    //     const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');

    //     // Filter datatable on submit
    //     filterButton.addEventListener('click', function () {
    //         // Get filter values
    //         let paymentValue = '';

    //         // Get payment value
    //         filterPayment.forEach(r => {
    //             if (r.checked) {
    //                 paymentValue = r.value;
    //             }

    //             // Reset payment value if "All" is selected
    //             if (paymentValue === 'all') {
    //                 paymentValue = '';
    //             }
    //         });

    //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         dt.search(paymentValue).draw();
    //     });
    // }

    // Delete customer
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-'+module+'-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const recName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + recName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                            deleteData($(e.target).data('id'), dt);

                    } 
                });
            })
        });
    }

    var deleteData = (id, dt) => {

        $.ajax({
            type: 'DELETE',
            url: config.apiURL + module ,
            dataType:"JSON",
            data: {id: id},
            beforeSend:function(){


            },
            success:function(data){

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    dt.draw();
                });


            },
            error:function(xhr, ajaxOptions, thrownError){
                //parseErrors(xhr.responseText, globalFormId + '-msg')
            }
        });        

    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-'+module+'-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Reset payment type
            filterPayment[0].checked = true;

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            dt.search('').draw();
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#'+module+'_listing');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-'+module+'-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {

            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete selected records?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                },
            }).then(function (result) {
                if (result.value) {
                    // Simulate delete request -- for demo purpose only

                        let ids = [];
                        $(".rec-checkbox:checked").each(function() {
                            ids.push(this.value);
                        });                        

                        deleteData(ids, dt);

                        // Swal.fire({
                        //     text: "You have deleted all selected records!.",
                        //     icon: "success",
                        //     buttonsStyling: false,
                        //     confirmButtonText: "Ok, got it!",
                        //     customClass: {
                        //         confirmButton: "btn fw-bold btn-primary",
                        //     }
                        // }).then(function () {
                        //     // delete row data from server and re-draw datatable
                        //     dt.draw();
                        // });

                        // Remove header checked box
                        const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;

                }
            });
        });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#'+module+'_listing');
        const toolbarBase = document.querySelector('[data-kt-'+module+'-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-'+module+'-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-'+module+'-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Public methods
    return {
        init: function () {

            initDatatable();
            handleSearchDatatable();
            initToggleToolbar();
            //handleFilterDatatable();
            handleDeleteRows();
            handleResetForm();
        }
    }
}();


function addUpdateTeam()
{

    $.ajax({
        type: getMethod(),
        url: config.apiURL + 'team' + route() ,
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){

            showNotif(globalFormId + '-msg', data.message, 'success');
            window.location = config.adminURL + 'subcontractor/' +$('#subcontractor_id').val() + '/teams';

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}

function addUpdateSuboperative(obj)
{
   var formData = new FormData(obj);
    $.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        url: config.apiURL + 'suboperative' + route() ,
        dataType:"JSON",
        data:  formData,
        enctype: 'multipart/form-data',
        beforeSend:function(){


        },
        success:function(data){

            var action = $('#id').val() != '' ? 'update' : 'save';
            // window.location = config.adminURL + 'suboperative/add?resp=' + action;
            location.reload();
        },
        error:function(xhr, ajaxOptions, thrownError){
            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}


var getSuboperativeListing = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var module = $('.module').data('module');

    // Private functions
    var initDatatable = function () {
        dt = $("#"+module+"_listing").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                // url: "https://preview.keenthemes.com/api/datatables.php",
                url: config.apiURL +  module +'s' + '/' + $('#subcontractor_id').val(),

            },
            columns: [
                { data: 'id' },
                { data: 'Name' },
                { data: 'mobile' },
                { data: 'email' },
                { data: 'status' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function (data) {

                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="rec-checkbox form-check-input" type="checkbox" value="${data}" />
                            </div>`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {
                         return `<a href="${config.adminURL}${module}/edit/${row.id}">${row.first_name}`+` `+`${row.last_name}</a>`;
                    }
                },

                {
                    targets: 2,
                    render: function (data, type, row) {
                         return `${row.mobile}`;
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, row) {
                         return `${row.email}`;
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, row) {
                         return `${row.status}`;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {

                        var editHtml = '';
                        var deleteHtml = '';


                        if(p.editSuboperative)
                        {
                            editHtml = `<div class="menu-item px-3">
                                    <a href="${config.adminURL}${module}/edit/${row.id}" class="menu-link px-3" data-kt-user-table-filter="edit_row">
                                        Edit
                                    </a>
                                </div>`;
                        }

                        if(p.deleteSuboperative)
                        {
                            deleteHtml = `<div class="menu-item px-3">
                                    <a href="javascript:void(0);" data-id="${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="delete_row">
                                        Delete
                                    </a>
                                </div>`;
                        }

                        return `
                            <a href="javascript:void(0);" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <!--end::Menu item-->
                                ${editHtml}
                                ${deleteHtml}
                                <!--begin::Menu item-->
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
            ],
            // Add data-filter attribute
            // createdRow: function (row, data, dataIndex) {
            //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            // }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-'+module+'-table-filter="search"]');

        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    // var handleFilterDatatable = () => {
    //     // Select filter options
    //     filterPayment = document.querySelectorAll('[data-kt-user-table-filter="payment_type"] [name="payment_type"]');
    //     const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');

    //     // Filter datatable on submit
    //     filterButton.addEventListener('click', function () {
    //         // Get filter values
    //         let paymentValue = '';

    //         // Get payment value
    //         filterPayment.forEach(r => {
    //             if (r.checked) {
    //                 paymentValue = r.value;
    //             }

    //             // Reset payment value if "All" is selected
    //             if (paymentValue === 'all') {
    //                 paymentValue = '';
    //             }
    //         });

    //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         dt.search(paymentValue).draw();
    //     });
    // }

    // Delete customer
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-'+module+'-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const recName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + recName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                            deleteData($(e.target).data('id'), dt);

                    } 
                });
            })
        });
    }

    var deleteData = (id, dt) => {

        $.ajax({
            type: 'DELETE',
            url: config.apiURL + module ,
            dataType:"JSON",
            data: {id: id},
            beforeSend:function(){


            },
            success:function(data){

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    dt.draw();
                });


            },
            error:function(xhr, ajaxOptions, thrownError){
                //parseErrors(xhr.responseText, globalFormId + '-msg')
            }
        });        

    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-'+module+'-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Reset payment type
            filterPayment[0].checked = true;

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            dt.search('').draw();
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#'+module+'_listing');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-'+module+'-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {

            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete selected records?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                },
            }).then(function (result) {
                if (result.value) {
                    // Simulate delete request -- for demo purpose only

                        let ids = [];
                        $(".rec-checkbox:checked").each(function() {
                            ids.push(this.value);
                        });                        

                        deleteData(ids, dt);

                        // Swal.fire({
                        //     text: "You have deleted all selected records!.",
                        //     icon: "success",
                        //     buttonsStyling: false,
                        //     confirmButtonText: "Ok, got it!",
                        //     customClass: {
                        //         confirmButton: "btn fw-bold btn-primary",
                        //     }
                        // }).then(function () {
                        //     // delete row data from server and re-draw datatable
                        //     dt.draw();
                        // });

                        // Remove header checked box
                        const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;

                }
            });
        });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#'+module+'_listing');
        const toolbarBase = document.querySelector('[data-kt-'+module+'-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-'+module+'-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-'+module+'-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Public methods
    return {
        init: function () {

            initDatatable();
            handleSearchDatatable();
            initToggleToolbar();
            //handleFilterDatatable();
            handleDeleteRows();
            handleResetForm();
        }
    }
}();


function getTeams(subcontractorId)
{
    $.ajax({
      type: 'GET',
      url: config.apiURL + 'teams/' + subcontractorId,
      dataType:"JSON",
      data: {},
      beforeSend:function(){

      },
      success:function(data){
        if(data.status == 'success')
        {
            var html = '<option value="">Select Team</option>';

            $.each(data.data, function(index, team){
                html += `<option value="${team.id}">${team.team}</option>`;
            });


            $('#team_id').html(html);
            // $("#team_id").select2("destroy");
            // $("#team_id").select2();
            getSubcontractorTeams(subcontractorId);

        }
      },
      error:function(xhr, ajaxOptions, thrownError){

      }
    });     
}

function getSubcontractorTeams(subcontractorId)
{
    $.ajax({
      type: 'GET',
      url: config.apiURL + 'subcontractor/'+subcontractorId+'/teams',
      data: {},
      beforeSend:function(){

      },
      success:function(data){

        $('#subcontractor_teams').html(data.html);
        jQuery( '.lightboxed' ).lightboxed(); 


      },
      error:function(xhr, ajaxOptions, thrownError){

      }
    });     
}


// var getProjectListing = function () {


//     // Shared variables
//     var table;
//     var dt;
//     var filterPayment;
//     var module = $('.module').data('module');

//     // Private functions
//     var initDatatable = function () {
//         dt = $("#"+module+"_listing").DataTable({
//             searchDelay: 500,
//             processing: true,
//             serverSide: true,
//             order: [[1, 'desc']],
//             paging: false,
//             stateSave: false,
//             select: {
//                 style: 'multi',
//                 selector: 'td:first-child input[type="checkbox"]',
//                 className: 'row-selected'
//             },
//             ajax: {
//                 // url: "https://preview.keenthemes.com/api/datatables.php",
//                 url: config.apiURL +'projesscts?status=' + $('input[name="status"]').val(),

//             },
//             columns: [
//                 { data: 'id' },
//                 { data: 'job_no' },
//                 { data: 'name' },
//                 { data: 'start_date' },
//                 { data: 'due_date' },
//                 { data: 'status' },
//                 { data: null },
//             ],
//             columnDefs: [
//                 {
//                     targets: 0,
//                     orderable: false,
//                     render: function (data) {

//                         return `
//                             <div class="form-check form-check-sm form-check-custom form-check-solid">
//                                 <input class="rec-checkbox form-check-input" type="checkbox" value="${data}" />
//                             </div>`;
//                     }
//                 },
//                 {
//                     targets: 1,
//                     render: function (data, type, row) {

//                          return `<a onclick="viewProject(${row.id});" href="javascript:void(0);">${row.job_no}</a>`;
//                     }
//                 },
//                 {
//                     targets: 2,
//                     render: function (data, type, row) {

//                          return `<a onclick="viewProject(${row.id});" href="javascript:void(0);">${row.name}</a>`;
//                     }
//                 },
//                 {
//                     targets: 3,
//                     render: function (data, type, row) {

//                          return `${row.start_date}`;
//                     }
//                 },
//                 {
//                     targets: 4,
//                     render: function (data, type, row) {

//                          return `${row.due_date}`;
//                     }
//                 },
//                  {
//                     targets: 5,
//                     render: function (data, type, row) {

//                          return `<span class="badge badge-light-${projectStatus[row.status]} flex-shrink-0 align-self-center py-3 px-4 fs-7">${row.status}</span>`;
//                     }
//                 },
//                 {
//                     targets: -1,
//                     data: null,
//                     orderable: false,
//                     className: 'text-end',
//                     render: function (data, type, row) {

//                         var editHtml = '';
//                         var deleteHtml = '';

//                         if(p.editProject)
//                         {
//                             editHtml = `<div class="menu-item px-3">
//                                     <a href="${config.adminURL}${module}/edit/${row.id}" class="menu-link px-3" data-kt-user-table-filter="edit_row">
//                                         Edit
//                                     </a>
//                                 </div>`;
//                         }

//                         if(p.deleteProject)
//                         {
//                             deleteHtml = `<div class="menu-item px-3">
//                                     <a href="javascript:void(0);" data-id="${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="delete_row">
//                                         Delete
//                                     </a>
//                                 </div>`;
//                         }

//                         return `
//                             <a href="javascript:void(0);" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
//                                 Actions
//                                 <span class="svg-icon svg-icon-5 m-0">
//                                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
//                                         <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
//                                             <polygon points="0 0 24 0 24 24 0 24"></polygon>
//                                             <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
//                                         </g>
//                                     </svg>
//                                 </span>
//                             </a>
//                             <!--begin::Menu-->
//                             <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
//                                 <!--begin::Menu item-->
//                                 ${editHtml}
//                                 <!--end::Menu item-->

//                                 <!--begin::Menu item-->
//                                 ${deleteHtml}
//                                 <!--end::Menu item-->
//                             </div>
//                             <!--end::Menu-->
//                         `;
//                     },
//                 },
//             ],
//             // Add data-filter attribute
//             // createdRow: function (row, data, dataIndex) {
//             //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
//             // }
//         });

//         table = dt.$;

//         // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
//         dt.on('draw', function () {
//             initToggleToolbar();
//             toggleToolbars();
//             handleDeleteRows();
//             KTMenu.createInstances();
//         });
//     }

//     // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
//     var handleSearchDatatable = function () {
//         const filterSearch = document.querySelector('[data-kt-'+module+'-table-filter="search"]');

//         filterSearch.addEventListener('keyup', function (e) {
//             dt.search(e.target.value).draw();
//         });
//     }

//     // Filter Datatable
//     // var handleFilterDatatable = () => {
//     //     // Select filter options
//     //     filterPayment = document.querySelectorAll('[data-kt-user-table-filter="payment_type"] [name="payment_type"]');
//     //     const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');

//     //     // Filter datatable on submit
//     //     filterButton.addEventListener('click', function () {
//     //         // Get filter values
//     //         let paymentValue = '';

//     //         // Get payment value
//     //         filterPayment.forEach(r => {
//     //             if (r.checked) {
//     //                 paymentValue = r.value;
//     //             }

//     //             // Reset payment value if "All" is selected
//     //             if (paymentValue === 'all') {
//     //                 paymentValue = '';
//     //             }
//     //         });

//     //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
//     //         dt.search(paymentValue).draw();
//     //     });
//     // }

//     // Delete customer
//     var handleDeleteRows = () => {
//         // Select all delete buttons
//         const deleteButtons = document.querySelectorAll('[data-kt-'+module+'-table-filter="delete_row"]');

//         deleteButtons.forEach(d => {
//             // Delete button on click
//             d.addEventListener('click', function (e) {
//                 e.preventDefault();

//                 // Select parent row
//                 const parent = e.target.closest('tr');

//                 // Get customer name
//                 const recName = parent.querySelectorAll('td')[1].innerText;

//                 // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
//                 Swal.fire({
//                     text: "Are you sure you want to delete " + recName + "?",
//                     icon: "warning",
//                     showCancelButton: true,
//                     buttonsStyling: false,
//                     confirmButtonText: "Yes, delete!",
//                     cancelButtonText: "No, cancel",
//                     customClass: {
//                         confirmButton: "btn fw-bold btn-danger",
//                         cancelButton: "btn fw-bold btn-active-light-primary"
//                     }
//                 }).then(function (result) {
//                     if (result.value) {
//                         // Simulate delete request -- for demo purpose only
//                             deleteData($(e.target).data('id'), dt);

//                     } 
//                 });
//             })
//         });
//     }

//     var deleteData = (id, dt) => {

//         $.ajax({
//             type: 'DELETE',
//             url: config.apiURL + module ,
//             dataType:"JSON",
//             data: {id: id},
//             beforeSend:function(){


//             },
//             success:function(data){

//                 Swal.fire({
//                     text: data.message,
//                     icon: "success",
//                     buttonsStyling: false,
//                     confirmButtonText: "Ok, got it!",
//                     customClass: {
//                         confirmButton: "btn fw-bold btn-primary",
//                     }
//                 }).then(function () {
//                     dt.draw();
//                 });


//             },
//             error:function(xhr, ajaxOptions, thrownError){
//                 //parseErrors(xhr.responseText, globalFormId + '-msg')
//             }
//         });        

//     }

//     // Reset Filter
//     var handleResetForm = () => {
//         // Select reset button
//         const resetButton = document.querySelector('[data-kt-'+module+'-table-filter="reset"]');

//         // Reset datatable
//         resetButton.addEventListener('click', function () {
//             // Reset payment type
//             filterPayment[0].checked = true;

//             // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
//             dt.search('').draw();
//         });
//     }

//     // Init toggle toolbar
//     var initToggleToolbar = function () {
//         // Toggle selected action toolbar
//         // Select all checkboxes
//         const container = document.querySelector('#'+module+'_listing');
//         const checkboxes = container.querySelectorAll('[type="checkbox"]');

//         // Select elements
//         const deleteSelected = document.querySelector('[data-kt-'+module+'-table-select="delete_selected"]');

//         // Toggle delete selected toolbar
//         checkboxes.forEach(c => {
//             // Checkbox on click event
//             c.addEventListener('click', function () {
//                 setTimeout(function () {
//                     toggleToolbars();
//                 }, 50);
//             });
//         });

//         // Deleted selected rows
//         deleteSelected.addEventListener('click', function () {

//             // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
//             Swal.fire({
//                 text: "Are you sure you want to delete selected records?",
//                 icon: "warning",
//                 showCancelButton: true,
//                 buttonsStyling: false,
//                 showLoaderOnConfirm: true,
//                 confirmButtonText: "Yes, delete!",
//                 cancelButtonText: "No, cancel",
//                 customClass: {
//                     confirmButton: "btn fw-bold btn-danger",
//                     cancelButton: "btn fw-bold btn-active-light-primary"
//                 },
//             }).then(function (result) {
//                 if (result.value) {
//                     // Simulate delete request -- for demo purpose only

//                         let ids = [];
//                         $(".rec-checkbox:checked").each(function() {
//                             ids.push(this.value);
//                         });                        

//                         deleteData(ids, dt);

//                         // Swal.fire({
//                         //     text: "You have deleted all selected records!.",
//                         //     icon: "success",
//                         //     buttonsStyling: false,
//                         //     confirmButtonText: "Ok, got it!",
//                         //     customClass: {
//                         //         confirmButton: "btn fw-bold btn-primary",
//                         //     }
//                         // }).then(function () {
//                         //     // delete row data from server and re-draw datatable
//                         //     dt.draw();
//                         // });

//                         // Remove header checked box
//                         const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
//                         headerCheckbox.checked = false;

//                 }
//             });
//         });
//     }

//     // Toggle toolbars
//     var toggleToolbars = function () {
//         // Define variables
//         const container = document.querySelector('#'+module+'_listing');
//         const toolbarBase = document.querySelector('[data-kt-'+module+'-table-toolbar="base"]');
//         const toolbarSelected = document.querySelector('[data-kt-'+module+'-table-toolbar="selected"]');
//         const selectedCount = document.querySelector('[data-kt-'+module+'-table-select="selected_count"]');

//         // Select refreshed checkbox DOM elements
//         const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

//         // Detect checkboxes state & count
//         let checkedState = false;
//         let count = 0;

//         // Count checked boxes
//         allCheckboxes.forEach(c => {
//             if (c.checked) {
//                 checkedState = true;
//                 count++;
//             }
//         });

//         // Toggle toolbars
//         if (checkedState) {
//             selectedCount.innerHTML = count;
//             toolbarBase.classList.add('d-none');
//             toolbarSelected.classList.remove('d-none');
//         } else {
//             toolbarBase.classList.remove('d-none');
//             toolbarSelected.classList.add('d-none');
//         }
//     }

//     // Public methods
//     return {
//         init: function () {

//             initDatatable();
//             handleSearchDatatable();
//             initToggleToolbar();
//             //handleFilterDatatable();
//             handleDeleteRows();
//             handleResetForm();
//         }
//     }
// }();

function addUpdateProject()
{

    $.ajax({
        type: getMethod(),
        url: config.apiURL + 'project' + route() ,
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){

            showNotif(globalFormId + '-msg', data.message, 'success');
            window.location = config.adminURL + 'projects/';            

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}

function backProjectList()
{
    $('.project-listing').show();
    $('.project-detail').html('');
    $('.page-heading').html('Project List');
}

function viewProject(projectId)
{
    $('.page-heading').html('<a href="javascript:void(0);" onclick="backProjectList();" class="btn btn-sm fw-bold btn-secondary">Back</a>');
   
    $.ajax({
        type: 'GET',
        url: config.apiURL + 'project/' + projectId,
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){
            $('.page-loader').show();    
            $('.project-listing').hide();
        },
        success:function(data){
            $('.page-loader').hide();    
            $('.project-detail').html(data.html);
        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });
}

function assignUser()
{
    $.ajax({
        type: getMethod(),
        url: config.apiURL + 'project/assign?people_id=' + $('#id').val() ,
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){

            window.onbeforeunload = function () {
            }

            if(data.status == 'success')
            {
                showNotif(globalFormId + '-msg', data.message, 'success');
                window.location = config.adminURL + 'people/edit/' + $('#id').val();            

            }
            else
            {
                Swal.fire({
                    text: data.message,
                    icon: "warning",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                })

            }                

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });             
}

function statusChange(id, status)
{
    $.ajax({
        type: 'PUT',
        url: config.apiURL + 'project/status/change',
        dataType:"JSON",
        data: {id: id, status:status},
        beforeSend:function(){


        },
        success:function(data){

            getProjects();

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });             
}


function getProjects()
{
    $.ajax({
        type: 'GET',
        url: config.apiURL + 'projects?status=' + $('input[name="status"]').val(),
        dataType:"JSON",
        data: {},
        beforeSend:function(){


        },
        success:function(data){

            $('.projects-list').html(data.html);
            KTMenu.createInstances();

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });             
}


function deleteAssignmentAlert(id)
{
    Swal.fire({
        text: "Are you sure you want to delete?",
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Yes, delete!",
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    }).then(function (result) {
        if (result.value) {
            // Simulate delete request -- for demo purpose only
                deleteAssignment(id);

        } 
    });
}


function deleteAssignment(id)
{
    $.ajax({
        type: 'DELETE',
        url: config.apiURL + 'project/assignment/' + id,
        dataType:"JSON",
        beforeSend:function(){


        },
        success:function(data){

            $('#assignment-' + id).remove();

            Swal.fire({
                text: data.message,
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn fw-bold btn-primary",
                }
            })

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         

}

function getDmy(date)
{
    var newdate = date.split("-").reverse().join("/");
    return newdate;
}

function showEditAssignment(id)
{
  $.ajax({
        type: 'GET',
        url: config.apiURL + 'project/assignment/' + id,
        dataType:"JSON",
        beforeSend:function(){


        },
        success:function(data){

            $('#assign_modal').modal('show');

            

            $('[name="assign_start_date"]').val(getDmy(data.data.start_date));
            $('[name="assign_end_date"]').val(getDmy(data.data.end_date));
            $('#assign_id').val(id);

            $('[name="project_id"]').val(data.data.project_id);
            $('[name="assign_doc_id"]').val(data.data.doc_id);

            $('select[name^="assign_doc_id"]').select2("destroy");
            $('select[name^="assign_doc_id"]').select2({
                placeholder: "Select Skill",
            });         

            $('select[name^="project_id"]').select2("destroy");
            $('select[name^="project_id"]').select2({
                placeholder: "Select Project",
            });         


            var startDate = $("#assign_form [name='project_id']").find(':selected').attr('start-date');
            var dueDate = $("#assign_form [name='project_id']").find(':selected').attr('due-date');

            initMinMaxDatePicker("[name='assign_end_date'], [name='assign_start_date']", startDate, dueDate);


        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         


}

function resetAssignForm()
{
    $('#assign_id').val('');    

    $('[name="assign_end_date"]').val('');
    $('[name="assign_start_date"]').val('');


    $('[name="project_id"]').val('');
    $('[name="assign_doc_id"]').val('');

    $('select[name^="assign_doc_id"]').select2("destroy");
    $('select[name^="assign_doc_id"]').select2({
        placeholder: "Select Skill",
    });         

    $('select[name^="project_id"]').select2("destroy");
    $('select[name^="project_id"]').select2({
        placeholder: "Select Project",
    });         


}


function resetTrainingForm()
{
    $('#training_form input').val('');

    initDatePicker("[name='course_date']");

    select2Patch('select[name^="doc_class"]', "#training_form");

}

function searchSubcontractor()
{
    $.ajax({
      type: 'GET',
      url: config.apiURL + 'subcontractors',
      dataType:"JSON",
      data: {search_term: $('#subcontractor_search').val(), "nopage": 1},
      beforeSend:function(){

      },
      success:function(data){
        if(data.status == 'success')
        {
            var html = '';
            if(data.data.length > 0)
            {
                $.each(data.data, function(index, subcontractor){
                    html += `       <div id="subcontractor-detail-${subcontractor.id}" class="d-flex flex-stack py-4" onclick="getSubcontractorDetail(${subcontractor.id});">
                                        <div class="d-flex align-items-center">
                                            <div class="ms-5">
                                                <a href="javascript:void(0);" class="fs-5 fw-bold text-gray-900 mb-2">${subcontractor.name}</a>
                                                <div class="fw-semibold text-muted"><i class="fas fa-map-marker-alt"></i> ${subcontractor.postcode}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="separator separator-dashed "></div>`;
                });                
            }
            else
            {
                html = '<div class="no-result text-gray-700 fs-3">No Subcontractors found</div>';
            }

            $('.subcontractor-list').html(html);

            var subcontractorId = $('#subcontractor_id').val();
            if(subcontractorId != '')
            {
                $('#subcontractor-detail-' + subcontractorId).trigger('click');
            }


        }
      },
      error:function(xhr, ajaxOptions, thrownError){

      }
    });     
}



function getSubcontractorDetail(subcontractorId)
{
    $('div').removeClass('people-active');
    $('#subcontractor-detail-' + subcontractorId).addClass('people-active');

    $.ajax({
      type: 'GET',
      url: config.apiURL + 'subcontractor/' + subcontractorId,
      dataType:"JSON",
      data: {},
      beforeSend:function(){
      },
      success:function(data){
        if(data.status == 'success')
        {

            $('#subcontractor-detail').html(data.html);


        }
      },
      error:function(xhr, ajaxOptions, thrownError){
        KTApp.unprogress(btn[0]);
        ParseErrors(xhr.responseText, 'form', 'stickyHead');

      }
    });     
}


function deleteProject(projectId)
{
    Swal.fire({
        text: "Are you sure you want to delete this project?",
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Yes, delete!",
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    }).then(function (result) {
        if (result.value) {
            // Simulate delete request -- for demo purpose only

            $.ajax({
                type: 'DELETE',
                url: config.apiURL + 'project/' + projectId ,
                dataType:"JSON",
                data: {},
                beforeSend:function(){


                },
                success:function(data){

                    Swal.fire({
                        text: data.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    }).then(function () {
                        getProjects();
                    });


                },
                error:function(xhr, ajaxOptions, thrownError){
                    //parseErrors(xhr.responseText, globalFormId + '-msg')
                }
            });    


        } 
    });
}


function manageSubcontractorTeams(subcontractorId)
{
    $.ajax({
      type: 'GET',
      url: config.apiURL + 'subcontractor/'+subcontractorId+'/manage-teams',
      data: {},
      beforeSend:function(){

      },
      success:function(data){



        $('#subcontractor_teams').html(data.html);
        $('select.project').select2({
            placeholder: "Select Project",
        });

        $(".range-picker").daterangepicker({
              autoUpdateInput: false,
        //    "autoApply": true,
            locale: {
                format: "DD/MM/YYYY",
                cancelLabel: 'Clear'

            }
        });


        $('.range-picker').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
        });

        $('.range-picker').on('apply.daterangepicker', function(ev, picker) {
              $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        });

      },
      error:function(xhr, ajaxOptions, thrownError){

      }
    });     
}




function updateTeam(id)
{
    var projectId = $('#project-' + id).val();
    var task = $('#task-' + id).val();
    var timeline = $('#timeline-' + id).val();


    $.ajax({
      type: 'PUT',
      dataType:"JSON",
      url: config.apiURL + 'team/'+id,
      data: {project_id: projectId, task:task, timeline:timeline},
      beforeSend:function(){

      },
      success:function(data){

         Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    manageSubcontractorTeams($('#subcontractor_id').val());
                });


      },
      error:function(xhr, ajaxOptions, thrownError){

      }
    });   

}

function showSheetField(id, obj)
{
    $(obj).hide();
    $('#sheet_url-' + id).show();
}

function removeFileObj(id, obj)
{
    $(obj).parent().remove();
    $(id).val('');
}

function deleteSubOperatives(teamId)
{
    Swal.fire({
        text: "Are you sure you want to delete all sub operatives from the system?",
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Yes, delete!",
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    }).then(function (result) {
        if (result.value) {

          $.ajax({
                type: 'delete',
                url: config.apiURL + 'suboperatives/team/' + teamId ,
                dataType:"JSON",
                data: {},
                beforeSend:function(){


                },
                success:function(data){

                    Swal.fire({
                        text: data.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    }).then(function () {
                        manageSubcontractorTeams($('#subcontractor_id').val());
                    });

                },
                error:function(xhr, ajaxOptions, thrownError){


                    //showNotif('#login_msg', xhr.responseText, 'error');
                    parseErrors(xhr.responseText, globalFormId + '-msg')
                }
            });         

        } 
    });
}

function addUpdateCompany()
{
    $('input[name="phone_full"]').val(fullPhone.getNumber());

    $.ajax({
        type: getMethod(),
        url: config.apiURL + 'tenant' + route() ,
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){

            showNotif(globalFormId + '-msg', data.message, 'success');
            window.location = config.adminURL + 'tenants';            

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}




function addMoreCertification()
{


        var html= `<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Certification</span>
                                    </label>
                                    <input name="certification[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" value="" />
                                </div>
                            </div>
                            <div class="col mt-15">
                                <a onclick="removeCert(this);" href="javascript:void(0);"><i class="fa-solid fa-trash text-danger"></i></a>                            </div>
                        </div>
`;



        $( ".more-cert" ).append( html );

        initDatePicker("[name^='holiday_from'], [name^='holiday_to']");


}

function handleFactAuthCode(formId)
{
        var form = document.querySelector(formId);
        var input1 = form.querySelector("[name=code_1]");
        var input2 = form.querySelector("[name=code_2]");
        var input3 = form.querySelector("[name=code_3]");
        var input4 = form.querySelector("[name=code_4]");
        var input5 = form.querySelector("[name=code_5]");
        var input6 = form.querySelector("[name=code_6]");

        input1.focus();

        input1.addEventListener("keyup", function() {
            if (this.value.length === 1) {
                input2.focus();
            }
        });

        input2.addEventListener("keyup", function() {
            if (this.value.length === 1) {
                input3.focus();
            }
        });

        input3.addEventListener("keyup", function() {
            if (this.value.length === 1) {
                input4.focus();
            }
        });

        input4.addEventListener("keyup", function() {
            if (this.value.length === 1) {
                input5.focus();
            }
        });

        input5.addEventListener("keyup", function() {
            if (this.value.length === 1) {
                input6.focus();
            }
        });
        
        input6.addEventListener("keyup", function() {
            if (this.value.length === 1) {
                input6.blur();
            }
        });


    }    


function removeCert(obj)
{
    $(obj).parent().parent().remove();
}


function populateCode()
{
    var code = '';

    for (var i = 1; i < 7; i++) 
    {
        code += $('input[name="code_'+i+'"]').val();
    }

    $('input[name="code"]').val(code);

}
function verifyCode()
{
    $.ajax({
        method : "POST", 
        type: "POST",
        url: config.apiURL + 'user/login' ,
        dataType:"JSON",
        data: {code: $('input[name="code"]').val(), user_email: $('input[name="user_email"]').val(), user_password:$('input[name="user_password"]').val()},
        beforeSend:function(){


        },
        success:function(data){

            if(data.status == 'success')
            {
                showNotif('#login_msg', data.message, 'success');

                if(data.tenant == 0)
                    window.location = config.adminURL + 'dashboard';            
                else
                    window.location = data.data.url + '?token=' + data.data.token;                            
            }
            else if(data.status == 'code_error')
            {
                showNotif('#two_fact_msg', 'Code is incorrect', 'error');
            }
            else if(data.status == 'sent')
            {

                $('#two_fact_msg').html('Please input code which we have sent on your ' + data.two_fact_auth);
                $('#two_fact_modal').modal('show');
                handleFactAuthCode('#two_fact_form');

            }


        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, '#login_msg')
        }
    });         
}


function addUpdateTraining(download)
{
    var peopleId = "";

    if($('.people_id').length)
        peopleId = $('.people_id').val()

    $.ajax({
        type: 'POST',
        url: config.apiURL + 'training?people_id=' + peopleId+'&download='+download,
        dataType:"JSON",
        data: $( globalFormId ).serialize(),
        beforeSend:function(){


        },
        success:function(data){

            $('#training_modal').modal('hide');

            window.onbeforeunload = function () {
            }

            if(download == 1)
            {
                window.location = `${config.adminURL}training/pdf/${data.id}`;

            }

            setTimeout(function() {
                if(peopleId != "")
                {
                    location.reload();
                    // window.location = config.adminURL + 'people/edit/' + $('.people_id').val();
                }
                else
                {
                    location.reload();
                }

        }, 2000);


        },
        error:function(xhr, ajaxOptions, thrownError){



            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}





function deleteTrainingAlert(id)
{
    Swal.fire({
        text: "Are you sure you want to delete?",
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Yes, delete!",
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    }).then(function (result) {
        if (result.value) {
            // Simulate delete request -- for demo purpose only
                deleteTraining(id);

        } 
    });
}


function deleteTraining(id)
{
    $.ajax({
        type: 'DELETE',
        url: config.apiURL + 'training/' + id,
        dataType:"JSON",
        beforeSend:function(){


        },
        success:function(data){

            $('#training-' + id).remove();

            Swal.fire({
                text: data.message,
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn fw-bold btn-primary",
                }
            })

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         

}





function showEditTraining(id)
{
  $.ajax({
        type: 'GET',
        url: config.apiURL + 'training/' + id,
        dataType:"JSON",
        beforeSend:function(){


        },
        success:function(data){
            $('[name="training_id"]').val(id);
            $('#training_modal').modal('show');

            $('[name="course_date"]').val(getDmy(data.data.course_date));
            $('[name="doc_class"]').val(data.data.doc_class);
            $('[name="course_provider"]').val(data.data.course_provider);
            $('[name="course_location"]').val(data.data.course_location);
            $('[name="assign_doc_id"]').val(data.data.doc_id);


            $('select[name^="doc_class"]').select2("destroy");
            $('select[name^="doc_class"]').select2({
                placeholder: "Select Skill",
            });         

            select2Patch('select[name^="doc_class"]', "#training_form");

            initDatePicker("[name='course_date']");


            // var optionsHtml = '<option value="">Select Skill</option>';
            // $.each(data.data.people.documents, function(index, value){
            //     var selected = "";

            //     if(value.id == data.data.document_id)
            //         selected = "selected";
            //     optionsHtml += '<option '+selected+' value="'+value.id+'">'+value.skill.certification+'</option>';
            // });

            // if($('#training_form select[name="doc_class"]').length > 0)
            //     $('#training_form select[name="doc_class"]').html(optionsHtml);











            $('.people_id').val(data.data.people.id);
            $('#t-name').html(data.data.people.first_name + ' ' + data.data.people.last_name);
            $('#t-address1').html(data.data.people.address1);
            $('#t-postcode').html(data.data.people.postcode);
            $('#t-dob').html(moment(data.data.people.dob).format('MM/DD/YYYY') );
            $('#t-ni_number').html(data.data.people.ni_number);
            $('#t-mobile').html(data.data.people.mobile);






        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         


}

var getBackupListing = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var module = $('.module').data('module');

    // Private functions
    var initDatatable = function () {
        dt = $("#"+module+"_listing").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                // url: "https://preview.keenthemes.com/api/datatables.php",
                url: config.apiURL + module +'s',

            },
            columns: [
                { data: 'backup' },
                { data: 'created_at' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function (data, type, row) {
                         return `${row.backup}`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {
                         return moment(row.created_at).format('DD MMM YYYY HH:mm A');
                    }
                },                
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {

                        var deleteHtml = '';

                        deleteHtml = `<div class="menu-item ">
                                <a href="#" data-id="${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="delete_row">
                                    Delete
                                </a>
                            </div>`;

                        var restoreHtml = '';

                        restoreHtml = `<div class="menu-item ">
                                <a href="javascript:void(0);" class="menu-link px-3" onclick="requestRestore(${row.id});">
                                    Request Restore
                                </a>
                            </div>`;

                        return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                ${restoreHtml}

                                ${deleteHtml}
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
            ],
            // Add data-filter attribute
            // createdRow: function (row, data, dataIndex) {
            //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            // }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-'+module+'-table-filter="search"]');

        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    // var handleFilterDatatable = () => {
    //     // Select filter options
    //     filterPayment = document.querySelectorAll('[data-kt-user-table-filter="payment_type"] [name="payment_type"]');
    //     const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');

    //     // Filter datatable on submit
    //     filterButton.addEventListener('click', function () {
    //         // Get filter values
    //         let paymentValue = '';

    //         // Get payment value
    //         filterPayment.forEach(r => {
    //             if (r.checked) {
    //                 paymentValue = r.value;
    //             }

    //             // Reset payment value if "All" is selected
    //             if (paymentValue === 'all') {
    //                 paymentValue = '';
    //             }
    //         });

    //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         dt.search(paymentValue).draw();
    //     });
    // }

    // Delete customer
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-'+module+'-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const recName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + recName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                            deleteData($(e.target).data('id'), dt);

                    } 
                });
            })
        });
    }

    var deleteData = (id, dt) => {

        $.ajax({
            type: 'DELETE',
            url: config.apiURL + module + '/' + id ,
            dataType:"JSON",
            data: {id: id},
            beforeSend:function(){


            },
            success:function(data){

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    dt.draw();
                });


            },
            error:function(xhr, ajaxOptions, thrownError){
                //parseErrors(xhr.responseText, globalFormId + '-msg')
            }
        });        

    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-'+module+'-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Reset payment type
            filterPayment[0].checked = true;

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            dt.search('').draw();
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#'+module+'_listing');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-'+module+'-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {

            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete selected records?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                },
            }).then(function (result) {
                if (result.value) {
                    // Simulate delete request -- for demo purpose only

                        let ids = [];
                        $(".rec-checkbox:checked").each(function() {
                            ids.push(this.value);
                        });                        

                        deleteData(ids, dt);

                        // Swal.fire({
                        //     text: "You have deleted all selected records!.",
                        //     icon: "success",
                        //     buttonsStyling: false,
                        //     confirmButtonText: "Ok, got it!",
                        //     customClass: {
                        //         confirmButton: "btn fw-bold btn-primary",
                        //     }
                        // }).then(function () {
                        //     // delete row data from server and re-draw datatable
                        //     dt.draw();
                        // });

                        // Remove header checked box
                        const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;

                }
            });
        });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#'+module+'_listing');
        const toolbarBase = document.querySelector('[data-kt-'+module+'-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-'+module+'-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-'+module+'-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Public methods
    return {
        init: function () {

            initDatatable();
            handleSearchDatatable();
            initToggleToolbar();
            //handleFilterDatatable();
            handleDeleteRows();
            handleResetForm();
        }
    }
}();


var getTrainingListing = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var module = $('.module').data('module');

    // Private functions
    var initDatatable = function (status) {

        if(status == 'Pending')
            var datatable = "#"+module+"_pending_listing";
        else
            var datatable = "#"+module+"_listing";

        dt = $(datatable).DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                // url: "https://preview.keenthemes.com/api/datatables.php",
                url: config.apiURL + module +'s?status=' + status,

            },
            columns: [
                { data: 'operative' },
                { data: 'competency' },
                { data: 'provider' },
                { data: 'course_date' },
                { data: '' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function (data, type, row) {
                         return `${row.people.first_name} ${row.people.last_name}`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {
                        var status = '';
                        if(row.doc != null)
                            status = row.doc.status;
                         return `<span class="me-4 w-25px status-${status}Training"></span> ${row.skill.certification}`;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, row) {
                         return `${row.course_provider}`;
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, row) {
                         return `<a href="${config.adminURL}${module}/pdf/${row.id}"><i class="fa-solid text-dark fa-file-pdf"></i> ${row.course_date}</a>`;
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, row) {
                         return ``;
                    }
                },                
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {

                        var editHtml = '';
                        var deleteHtml = '';
                        var uploadSkill = '';


                        if(p.deleteSite)
                        {
                            deleteHtml = `<div class="menu-item px-3">
                                    <a href="#" data-id="${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="delete_row">
                                        Delete
                                    </a>
                                </div>`;
                        }
                        var completed = '';

                        if(row.status == 'Active')
                        {
                            if(p.editSite)
                            {
                                editHtml = `<div class="menu-item px-3">
                                        <a href="javascript:void(0);" onclick="showEditTraining(${row.id});" class="menu-link px-3" data-kt-${module}-table-filter="edit_row">
                                            Edit
                                        </a>
                                    </div>`;
                            }

                            completed = `<div class="menu-item px-3">
                                    <a href="javascript:void(0);" onclick="changeTrainingStatus(${row.id}, 'Pending');" class="menu-link px-3">
                                        Completed
                                    </a>
                                </div>`;
                        }

                        if(row.status == 'Pending')
                        {
                            if(row.doc_id == null)
                            {
                                row.doc_id = 0;
                                var action = `addDoc(${row.id})`;
                            }
                            else
                            {
                                var action = `editTraingDoc(${row.doc_id}, ${row.id})`;
                            }


                                uploadSkill = `<div class="menu-item px-3">
                                        <a href="javascript:void(0);" onclick="${action}" class="menu-link px-3" data-kt-${module}-table-filter="edit_row">
                                            Upload Docs
                                        </a>
                                    </div>`;
                        }

                        return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                ${editHtml}
                                ${uploadSkill}
                                <!--end::Menu item-->

                                <div class="menu-item px-3">
                                    <a href="${config.adminURL}${module}/pdf/${row.id}" class="menu-link px-3">
                                        PDF
                                    </a>
                                </div>


                                ${completed}

                                <!--begin::Menu item-->
                                ${deleteHtml}
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
            ],
            // Add data-filter attribute
            // createdRow: function (row, data, dataIndex) {
            //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            // }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-'+module+'-table-filter="search"]');

        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    // var handleFilterDatatable = () => {
    //     // Select filter options
    //     filterPayment = document.querySelectorAll('[data-kt-user-table-filter="payment_type"] [name="payment_type"]');
    //     const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');

    //     // Filter datatable on submit
    //     filterButton.addEventListener('click', function () {
    //         // Get filter values
    //         let paymentValue = '';

    //         // Get payment value
    //         filterPayment.forEach(r => {
    //             if (r.checked) {
    //                 paymentValue = r.value;
    //             }

    //             // Reset payment value if "All" is selected
    //             if (paymentValue === 'all') {
    //                 paymentValue = '';
    //             }
    //         });

    //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         dt.search(paymentValue).draw();
    //     });
    // }

    // Delete customer
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-'+module+'-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const recName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + recName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                            deleteData($(e.target).data('id'), dt);

                    } 
                });
            })
        });
    }

    var deleteData = (id, dt) => {

        $.ajax({
            type: 'DELETE',
            url: config.apiURL + module + '/' + id ,
            dataType:"JSON",
            data: {id: id},
            beforeSend:function(){


            },
            success:function(data){

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    dt.draw();
                });


            },
            error:function(xhr, ajaxOptions, thrownError){
                //parseErrors(xhr.responseText, globalFormId + '-msg')
            }
        });        

    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-'+module+'-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Reset payment type
            filterPayment[0].checked = true;

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            dt.search('').draw();
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#'+module+'_listing');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-'+module+'-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {

            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete selected records?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                },
            }).then(function (result) {
                if (result.value) {
                    // Simulate delete request -- for demo purpose only

                        let ids = [];
                        $(".rec-checkbox:checked").each(function() {
                            ids.push(this.value);
                        });                        

                        deleteData(ids, dt);

                        // Swal.fire({
                        //     text: "You have deleted all selected records!.",
                        //     icon: "success",
                        //     buttonsStyling: false,
                        //     confirmButtonText: "Ok, got it!",
                        //     customClass: {
                        //         confirmButton: "btn fw-bold btn-primary",
                        //     }
                        // }).then(function () {
                        //     // delete row data from server and re-draw datatable
                        //     dt.draw();
                        // });

                        // Remove header checked box
                        const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;

                }
            });
        });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#'+module+'_listing');
        const toolbarBase = document.querySelector('[data-kt-'+module+'-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-'+module+'-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-'+module+'-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Public methods
    return {
        init: function (status) {

            initDatatable(status);
            handleSearchDatatable();
            initToggleToolbar();
            //handleFilterDatatable();
            handleDeleteRows();
            handleResetForm();
        }
    }
}();

function select2Patch(selector, modal)
{
    $(selector).select2({
        dropdownParent: $(modal)
    });

}

function getProjectDates()
{
    var startDate = $("#assign_form [name='project_id']").find(':selected').attr('start-date');
    var dueDate = $("#assign_form [name='project_id']").find(':selected').attr('due-date');

    initMinMaxDatePicker("[name='assign_end_date'], [name='assign_start_date']", startDate, dueDate);
}

function renderStats()
{
    $.ajax({
        type: 'GET',
        url: config.apiURL + 'stats',
        dataType:"JSON",
        data: {},
        beforeSend:function(){


        },
        success:function(data){

            peopleChart(data.people_stats);
            suboperativeChart(data.suboperative_stats);
            skillsChart(data.skills_stats);
            expiredEkillsChart(data.skills_stats);
            trainingChart(data.training_stats);
            projectChart(data.project_stats);
            subcontractorChart(data.subcontractor_stats);
        },
        error:function(xhr, ajaxOptions, thrownError){

            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}


function suboperativeChart(stats)
{
    var xValues = ["Active ("+stats.active+")" , "Inactive ("+stats.inactive+")", "Total ("+stats.total+")"];
    var yValues = [stats.active, stats.inactive, ""];
    var barColors = [
      "#008000",
      "#ff0000",
      "#7239ea",
    ];

    new Chart("suboperative_chart", {
      type: "doughnut",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        plugins: {
            legend: {
                display: true,
                align: "start",
            }
        },

        title: {
          display: true,
          text: "World Wide Wine Production 2018"
        }
      }
    });

}



function peopleChart(stats)
{
    var xValues = ["Active ("+stats.active+")" , "Inactive ("+stats.inactive+")", "Total ("+stats.total+")"];
    var yValues = [stats.active, stats.inactive, ""];
    var barColors = [
      "#008000",
      "#ff0000",
      "#0096FF",
    ];

    new Chart("people_chart", {
      type: "doughnut",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        plugins: {
            legend: {
                display: true,
                align: "start",
            }
        },

        title: {
          display: true,
          text: "World Wide Wine Production 2018"
        }
      }
    });

}

function skillsChart(stats)
{
    var xValues = ['Active ' + stats.active , 'Expiring '  + stats.expiring ,'Critical '  + stats.critical];
    var yValues = [stats.active, stats.expiring,stats.critical];
    var barColors = [
      "#008000",
      "#ffa500",
      "#ff0000",
    ];

    new Chart("skills_chart", {
      type: "doughnut",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        plugins: {
            legend: {
                display: true,
                align: "start",
            }
        },

        title: {
          display: true,
          text: "World Wide Wine Production 2018"
        }
      }
    });

}

function expiredEkillsChart(stats)
{
    var xValues = [' ','Expired ' + stats.expired];
    var yValues = [' ', stats.expired];
    var barColors = [
      "#ffffff",
      "#A9A9A9",

    ];

    new Chart("expired_skills_chart", {
      type: "doughnut",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        plugins: {
            legend: {
                display: true,
                align: "start",
            }
        },

        title: {
          display: true,
          text: "World Wide Wine Production 2018"
        }
      }
    });

}

function trainingChart(stats)
{
    var xValues = ['Active ' + stats.active, 'Pending ' + stats.pending, 'Expired ' + stats.expired ];
    var yValues = [stats.active, stats.pending, stats.expired];
    var barColors = [
      "#5D3FD3",
      "#ffa500",
      "#A9A9A9",
    ];

    new Chart("training_chart", {
      type: "doughnut",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        plugins: {
            legend: {
                display: true,
                align: "start",
            }
        },

        title: {
          display: true,
          text: "World Wide Wine Production 2018"
        }
      }
    });

}

function subcontractorChart(stats)
{
    var xValues = ['Active ' + stats.active, 'Inactive ' + stats.inactive];
    var yValues = [stats.active, stats.inactive];
    var barColors = [
      "#008000",
      "#A9A9A9"
    ];

    new Chart("subcontractor_chart", {
      type: "doughnut",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        plugins: {
            legend: {
                display: true,
                align: "start",
            }
        },

        title: {
          display: true,
          text: "World Wide Wine Production 2018"
        }
      }
    });

}



function projectChart(stats)
{
    var xValues = ['Planning ' + stats.planning, 'Active ' + stats.active, 'Complete ' + stats.complete ];
    var yValues = [stats.planning, stats.active, stats.approvals];
    var barColors = [
      "#009ef7",
      "#7239ea",
      "#50cd89",
    ];

    new Chart("project_chart", {
      type: "doughnut",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        plugins: {
            legend: {
                display: true,
                align: "start",
            }
        },

        title: {
          display: true,
          text: "World Wide Wine Production 2018"
        }
      }
    });

}

function subcontractorTeams(subcontractorId)
{

 $.ajax({
        type: 'GET',
        url: config.apiURL + 'teams/' + subcontractorId,
        dataType:"JSON",
        data: {},
        beforeSend:function(){


        },
        success:function(data){

            var html = '';
            $.each(data.data, function(index, value){

                var taskCount = '';
                if(value.tasks_count > 0)
                    taskCount = `<span  class="menu-badge position-absolute" style="left:30%;">
                                                    <span class="badge badge-danger badge-circle fw-bold fs-7">${value.tasks_count}</span>
                                                </span>`;

                html += `<li onclick="getTeamTasks(${value.id});" class="team-${value.id} nav-item w-100 me-0 mb-md-2">
                                <a class="nav-link w-100 active btn btn-flex btn-active-light-dark" data-bs-toggle="tab" href="#logos_tab">
                                    <span class="d-flex flex-column align-items-start">
                                        <span class="fs-7 fw-bold">${value.team}</span>
                                    </span>
                                    ${taskCount}
                                </a>
                            </li>`;
            });

            $('.addtaskbtn').attr('onclick','getTask(0,'+subcontractorId+')')
            $('.team-list').html(html);
            $('#subcontractor_teams').removeClass('d-none')
            $('.team-list').html(html);
            $(".team-list li:first-child").trigger('click');


        },
        error:function(xhr, ajaxOptions, thrownError){

            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });        
}


function getSuboperativeSkills(obj)
{
    $.ajax({
        type: 'GET',
        url: config.apiURL + 'suboperative-documents',
        dataType:"JSON",
        data: {id: obj.value},
        beforeSend:function(){


        },
        success:function(data){

            var html = '<option value="">Select Skill</option>';
            $.each(data.documents, function(index, value){
                html += `<option value="${value.id}">${value.skill.certification}</option>`;
            });

            $(obj).parent().parent().parent().find('.skills').html(html);


        },
        error:function(xhr, ajaxOptions, thrownError){

            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });   
}

function removeSubop(obj)
{
   $(obj).parent().parent().parent().find('select').remove();
   $(obj).parent().parent().parent().hide();
}

function addMoreSuboperative()
{

    var subopertiveList = $("select[name^='suboperative']").first().html();   
    var taskId = $("input[name='module_id']").val();  
    if(taskId != '')
        subopertiveList = '<option value="">Select Suboperative</option>' + subopertiveList;
    subopertiveList = subopertiveList.replace('selected=""', "");


    html =  `<div class="row">
        <div class="col-lg-6">
            <div class="fv-row mb-2">
                <label class="fs-6 fw-semibold form-label">
                    <span>Suboperative</span>
                </label>
                <select name="suboperative[]" onchange="getSuboperativeSkills(this);" aria-label="Select a Suboperative" class="form-select form-select-solid form-select-lg">
                    ${subopertiveList}
                </select>                                   
            </div>
        </div>
        <div class="col-lg-5">
            <div class="fv-row mb-2">
                <label class="fs-6 fw-semibold form-label">
                    <span>Skill</span>
                </label>
                <select name="skill[]" aria-label="Select Skill" class="form-select skills form-select-solid form-select-lg">
                    <option value="">Select Suboperative First</option>
                </select>                                   
            </div>
        </div>
        <div class="col-lg-1">
            <div class="fv-row mb-2">
                <a onclick="removeSubop(this);" href="javascript:void(0);"><i class="fa-solid fa-trash fs-1 text-danger" style="margin-top: 42px;"></i></a>
            </div>
        </div>
    </div>
`;
    

    $('.suboperatives-list').append(html);
}

function addUpdateTeamTask()
{

    $.ajax({
        type: getMethod(),
        url: config.apiURL + 'teamtask' + route(),
        dataType:"JSON",
        data: $( globalFormId ).serialize() + '&subcontractor_id=' + $('#subcontractor_id').val(),
        beforeSend:function(){


        },
        success:function(data){
            $('#task_modal').modal('hide');
            teamId = $('input[name="team_id"]').val();
            getTeamTasks(teamId)
        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });         
}

function getTeamTasks(teamId)
{
    $('input[name="team_id"]').val(teamId);

    $('#subcontractor_teams li a').addClass('btn-active-light-dark');
    $('#subcontractor_teams li a').removeClass('btn-active-light-danger');
    $('.team-' + teamId + ' a').removeClass('btn-active-light-dark');
    $('.team-' + teamId + ' a').addClass('btn-active-light-danger');

    $('#teamtask_listing').DataTable().clear().destroy();

    getTeamTaskListing.init();


}

var getTeamTaskListing = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var module = $('.module').data('module');

    // Private functions
    var initDatatable = function () {
        var teamId = $('input[name="team_id"]').val();
        dt = $("#"+module+"_listing").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                // url: "https://preview.keenthemes.com/api/datatables.php",
                url: config.apiURL +  module +'s?team_id=' + teamId,

            },
            columns: [
                { data: 'project' },
                { data: 'task' },
                { data: 'timeline' },
                { data: 'subops' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function (data, type, row) {
                         return `${row.project.name}`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {
                         return `${row.task}`;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, row) {
                         return `${moment(row.start_date).format('DD MMM YYYY')}<br>${moment(row.end_date).format('DD MMM YYYY')}`;
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, row) {

                        var subopCount = row.suboperatives.length;
                        var s = '';
                        
                        if(subopCount > 1)
                            s = 's';

                        return `<a onclick="getTaskSubops(${row.id});" href="javascript:void(0);">${row.suboperatives.length} Subop ${s}</a>`;
                        
                        // var html = '';

                        // $.each(row.suboperatives, function( field, subop ) {
                        //     html += subop.suboperative.first_name + ' ' + subop.suboperative.last_name +'<br>';
                        // });

                        // return html;

                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {

                        var editHtml = '';
                        var deleteHtml = '';

                        if(p.editTeam)
                        {
                            editHtml = `<div class="menu-item px-3">
                                    <a href="javascript:void(0);" onclick="getTask(${row.id}, ${row.subcontractor_id});" class="menu-link px-3" data-kt-user-table-filter="edit_row">
                                        Edit
                                    </a>
                                </div>`;
                        }

                        if(p.deleteTeam)
                        {
                            deleteHtml = `<div class="menu-item px-3">
                                    <a href="javascript:void(0);" data-id="${row.id}" class="menu-link px-3" data-kt-${module}-table-filter="delete_row">
                                        Delete
                                    </a>
                                </div>`;
                        }

                        return `
                            <a href="javascript:void(0);" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <!--end::Menu item-->
                                ${editHtml}
                                ${deleteHtml}
                                <!--begin::Menu item-->
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
            ],
            // Add data-filter attribute
            // createdRow: function (row, data, dataIndex) {
            //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            // }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    // var handleSearchDatatable = function () {
    //     const filterSearch = document.querySelector('[data-kt-'+module+'-table-filter="search"]');

    //     filterSearch.addEventListener('keyup', function (e) {
    //         dt.search(e.target.value).draw();
    //     });
    // }

    // Filter Datatable
    // var handleFilterDatatable = () => {
    //     // Select filter options
    //     filterPayment = document.querySelectorAll('[data-kt-user-table-filter="payment_type"] [name="payment_type"]');
    //     const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');

    //     // Filter datatable on submit
    //     filterButton.addEventListener('click', function () {
    //         // Get filter values
    //         let paymentValue = '';

    //         // Get payment value
    //         filterPayment.forEach(r => {
    //             if (r.checked) {
    //                 paymentValue = r.value;
    //             }

    //             // Reset payment value if "All" is selected
    //             if (paymentValue === 'all') {
    //                 paymentValue = '';
    //             }
    //         });

    //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         dt.search(paymentValue).draw();
    //     });
    // }

    // Delete customer
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-'+module+'-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const recName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + recName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                            deleteData($(e.target).data('id'), dt);

                    } 
                });
            })
        });
    }

    var deleteData = (id, dt) => {

        $.ajax({
            type: 'DELETE',
            url: config.apiURL + module ,
            dataType:"JSON",
            data: {id: id},
            beforeSend:function(){


            },
            success:function(data){

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    dt.draw();
                });


            },
            error:function(xhr, ajaxOptions, thrownError){
                //parseErrors(xhr.responseText, globalFormId + '-msg')
            }
        });        

    }

    // Reset Filter
    // var handleResetForm = () => {
    //     // Select reset button
    //     const resetButton = document.querySelector('[data-kt-'+module+'-table-filter="reset"]');

    //     // Reset datatable
    //     resetButton.addEventListener('click', function () {
    //         // Reset payment type
    //         filterPayment[0].checked = true;

    //         // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         dt.search('').draw();
    //     });
    // }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#'+module+'_listing');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        // const deleteSelected = document.querySelector('[data-kt-'+module+'-table-select="delete_selected"]');

        // // Toggle delete selected toolbar
        // checkboxes.forEach(c => {
        //     // Checkbox on click event
        //     c.addEventListener('click', function () {
        //         setTimeout(function () {
        //             toggleToolbars();
        //         }, 50);
        //     });
        // });

        // Deleted selected rows
        // deleteSelected.addEventListener('click', function () {

        //     // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
        //     Swal.fire({
        //         text: "Are you sure you want to delete selected records?",
        //         icon: "warning",
        //         showCancelButton: true,
        //         buttonsStyling: false,
        //         showLoaderOnConfirm: true,
        //         confirmButtonText: "Yes, delete!",
        //         cancelButtonText: "No, cancel",
        //         customClass: {
        //             confirmButton: "btn fw-bold btn-danger",
        //             cancelButton: "btn fw-bold btn-active-light-primary"
        //         },
        //     }).then(function (result) {
        //         if (result.value) {
        //             // Simulate delete request -- for demo purpose only

        //                 let ids = [];
        //                 $(".rec-checkbox:checked").each(function() {
        //                     ids.push(this.value);
        //                 });                        

        //                 deleteData(ids, dt);

        //                 // Swal.fire({
        //                 //     text: "You have deleted all selected records!.",
        //                 //     icon: "success",
        //                 //     buttonsStyling: false,
        //                 //     confirmButtonText: "Ok, got it!",
        //                 //     customClass: {
        //                 //         confirmButton: "btn fw-bold btn-primary",
        //                 //     }
        //                 // }).then(function () {
        //                 //     // delete row data from server and re-draw datatable
        //                 //     dt.draw();
        //                 // });

        //                 // Remove header checked box
        //                 const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
        //                 headerCheckbox.checked = false;

        //         }
        //     });
        // });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#'+module+'_listing');
        const toolbarBase = document.querySelector('[data-kt-'+module+'-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-'+module+'-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-'+module+'-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        // if (checkedState) {
        //     selectedCount.innerHTML = count;
        //     toolbarBase.classList.add('d-none');
        //     toolbarSelected.classList.remove('d-none');
        // } else {
        //     toolbarBase.classList.remove('d-none');
        //     toolbarSelected.classList.add('d-none');
        // }
    }

    // Public methods
    return {
        init: function () {

            initDatatable();
         //   handleSearchDatatable();
            initToggleToolbar();
            //handleFilterDatatable();
            handleDeleteRows();
           // handleResetForm();
        }
    }
}();


function getTask(id,subcontractorId)
{

    $('#task_modal').modal('show');
    $.ajax({
        type: 'GET',
        url: config.apiURL + 'teamtask/form?subcontractor_id='+subcontractorId,
        dataType:"JSON",
        data: {id:id},
        beforeSend:function(){


        },
        success:function(data){

            $('#task_modal .modal-body').html(data.html);

            $(".range-picker").daterangepicker({
                  autoUpdateInput: false,
            //    "autoApply": true,
                locale: {
                    format: "DD/MM/YYYY",
                    cancelLabel: 'Clear'

                }
            });


            $('.range-picker').on('cancel.daterangepicker', function(ev, picker) {
              $(this).val('');
            });

            $('.range-picker').on('apply.daterangepicker', function(ev, picker) {
                  $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            });
          
        },
        error:function(xhr, ajaxOptions, thrownError){

            parseErrors(xhr.responseText, globalFormId + '-msg')
        }
    });     

}



function createBackup()
{
    $.ajax({
        method : "POST", 
        type: "POST",
        url: config.apiURL + 'backup' ,
        dataType:"JSON",
        data: {},
        beforeSend:function(){

            $('.create-btn i').removeClass('d-none');

        },
        success:function(data){

            if(data.status == 'success')
            {
                $('.create-btn i').addClass('d-none');

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {

                    $('#backup_listing').DataTable().clear().destroy();

                    getBackupListing.init();

                });

            }
            else
            {

                Swal.fire({
                    text: data.message,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                    }
                })                
            }

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, '#login_msg')
        }
    });         
}


function getTaskSubops(id)
{
    $.ajax({
        method : "GET", 
        type: "GET",
        url: config.apiURL + 'teamtask/' + id+ '/suboperatives' ,
        dataType:"JSON",
        data: {},
        beforeSend:function(){


        },
        success:function(data){

            $('#task_subops').modal('show');
            $('.subop_listing tbody').html('');

            var subopHtml = '';
            $.each(data.subops, function(index, value){

                subopHtml += `<tr>
                                <td>${value.suboperative.first_name} ${value.suboperative.last_name}</td>
                                <td>${value.document.skill.certification}</td>
                                <td><i onclick="deleteTaskSubop(${value.id}, ${id})" class="fs-6 me-3 d-block text-danger fas fa-trash"></i></td>
                            </tr>`;



                $('.subop_listing tbody').html(subopHtml);
            });
        },
        error:function(xhr, ajaxOptions, thrownError){

            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, '#login_msg')
        }
    });         
}

function deleteTaskSubop(id, taskId)
{
     Swal.fire({
                text: "Are you sure you want to delete?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function (result) {
                if (result.value) {
                    // Simulate delete request -- for demo purpose only
                    $.ajax({
                        method : "DELETE", 
                        type: "DELETE",
                        url: config.apiURL + 'teamtask/' + id+ '/suboperative' ,
                        dataType:"JSON",
                        data: {},
                        beforeSend:function(){


                        },
                        success:function(data){

                            Swal.fire({
                                text: data.message,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            }).then(function () {
                                getTaskSubops(taskId);
                            });

                        },
                        error:function(xhr, ajaxOptions, thrownError){

                            //showNotif('#login_msg', xhr.responseText, 'error');
                            parseErrors(xhr.responseText, '#login_msg')
                        }
                    });         

                } 
            });
}


function checkExpiredSkill(obj)
{
    var status = $(obj).find(':selected').data('status');

    if(status == 'Expired')
    {
        Swal.fire({
            text: 'This skill is ' + status,
            icon: "danger",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn fw-bold btn-primary",
            }
        }).then(function () {

            $('[name="assign_doc_id"]').val("");

            $('select[name^="assign_doc_id"]').select2("destroy");
            $('select[name^="assign_doc_id"]').select2({
                placeholder: "Select Skill",
            });         

        });        


    }


}




function printThis()
{
    // $('div').removeAttr('data-kt-scroll');
    // $('div').removeAttr('data-kt-scroll-activate');
    // $('div').removeAttr('data-kt-scroll-max-height');

    // $('#kt_chat_contacts_body').find('div:first').removeAttr('class');

    // $('#kt_app_content').printThis({

    // });


}


function changeTrainingStatus(id, status)
{
    $.ajax({
        method : "PUT", 
        type: "PUT",
        url: config.apiURL + 'training/status',
        dataType:"JSON",
        data: {status:status, id:id},
        beforeSend:function(){


        },
        success:function(data){

            location.reload();
    
        },
        error:function(xhr, ajaxOptions, thrownError){

            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, '#login_msg')
        }
    });         
}




function getPeopleTraining(peopleId, docClass)
{
    $('.people_id').val(peopleId);
    resetTrainingForm();
    $('#training_modal').modal('show');

    $.ajax({
      type: 'GET',
      url: config.apiURL + 'people/' + peopleId,
      dataType:"JSON",
      data: {},
      beforeSend:function(){
      },
      success:function(data){
        if(data.status == 'success')
        {
            $('#t-name').html(data.data.first_name + ' ' + data.data.last_name);
            $('#t-address1').html(data.data.address1);
            $('#t-postcode').html(data.data.postcode);
            $('#t-dob').html(data.data.dob);
            $('#t-ni_number').html(data.data.ni_number);
            $('#t-mobile').html(data.data.mobile);

            $('select[name^="doc_class"] option').attr('disabled', 'disabled');
            $('select[name^="doc_class"] option[value="'+docClass+'"]').removeAttr('disabled');       
            $('select[name^="doc_class"]').val(docClass);
            $('select[name^="doc_class"]').trigger('change.select2');



        }
      },
      error:function(xhr, ajaxOptions, thrownError){

      }
    });     

}

// getPeopleDetail(`+people.id+`)

function editTraingDoc(docId, trainingId)
{
    $('#training_id').val(trainingId);
    editDoc(docId);
}


function requestRestore(backupId)
{

    $.ajax({
        method : "POST", 
        type: "POST",
        url: config.apiURL + 'restore/' + backupId ,
        dataType:"JSON",
        data: {},
        beforeSend:function(){

            $('.create-btn i').removeClass('d-none');

        },
        success:function(data){

            if(data.status == 'success')
            {
                $('.create-btn i').addClass('d-none');

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {

                    $('#backup_listing').DataTable().clear().destroy();

                    getBackupListing.init();

                });

            }
//             else
//             {
// 
//                 Swal.fire({
//                     text: data.message,
//                     icon: "error",
//                     buttonsStyling: false,
//                     confirmButtonText: "Ok, got it!",
//                     customClass: {
//                         confirmButton: "btn fw-bold btn-danger",
//                     }
//                 })                
//             }

        },
        error:function(xhr, ajaxOptions, thrownError){


            //showNotif('#login_msg', xhr.responseText, 'error');
            parseErrors(xhr.responseText, '#login_msg')
        }
    });         

}

function changePeopleStatusRequest(peopleId, status, reason)
{


            $.ajax({
                type: 'PUT',
                url: config.apiURL + 'people/status',
                dataType:"JSON",
                data: {people_id: peopleId, status:status, reason:reason},
                beforeSend:function(){


                },
                success:function(data){

                    if($('#banned_listing').length)
                    {
                        $('#banned_listing').DataTable().clear().destroy();
                        getBannedListing.init();

                    }
                    if($('#deactivated_listing').length)
                    {
                        $('#deactivated_listing').DataTable().clear().destroy();
                        getDeactivatedListing.init();

                    }
                    else
                        getPeopleDetail(peopleId);                    

                },
                error:function(xhr, ajaxOptions, thrownError){


                    //showNotif('#login_msg', xhr.responseText, 'error');
                    parseErrors(xhr.responseText, globalFormId + '-msg')
                }
            });           
}

function changePeopleStatus(peopleId, status, curStatus)
{
    if(curStatus == 'Active')
    {
        Swal.fire({
          title: "Error",
          text: "This person is active. Please remove it from project first.",
          icon: "danger"
        });

        return false;
    }


    if(status == 'Banned' || status == 'Deactivated')
    {
        Swal.fire({
          title: "Provide the reason",
          input: "text",
          inputAttributes: {
            autocapitalize: "off"
          },
          showCancelButton: true,
          icon: "warning",
          confirmButtonText: "Submit",
          showLoaderOnConfirm: true,
          preConfirm: async (reason) => {

            changePeopleStatusRequest(peopleId, status, reason);

          },
          allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: "Status Updated",
              text: "This person has now been " + status,
              icon: "success"
            });
          }
        });

    }
    else
    {
            Swal.fire({
        text: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Yes!",
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    }).then(function (result) {
        if (result.value) {
            // Simulate delete request -- for demo purpose only

            changePeopleStatusRequest(peopleId, status, '');   
        } 
    });    
    }


}





var getBannedListing = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var module = 'banned';

    // Private functions
    var initDatatable = function () {
        dt = $("#"+module+"_listing").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                // url: "https://preview.keenthemes.com/api/datatables.php",
                url: config.apiURL +'people/banned',

            },
            columns: [
                { data: 'name' },
                { data: 'date' },
                { data: 'reason' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function (data, type, row) {

                         return `${row.first_name} ${row.last_name}`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {

                         return `${row.status_date}`;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, row) {

                         return `${row.reason}`;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {

                        var banned = '';
                        var deleteHtml = '';

                            

                        return `<a href="javascript:void(0);" onclick="deletePeople(${row.id});" class="btn btn-icon btn-danger profile-btn"><i class="bi bi-trash-fill fs-4"></i></a>
                                <a href="javascript:void(0);" onclick="changePeopleStatus(${row.id}, 'Inactive', '${row.status}');" class="btn btn-icon btn-danger profile-btn"><i title="Unban" class="fa-solid fa-ban"></i></a>
                                `;
                    },
                },
            ],
            // Add data-filter attribute
            // createdRow: function (row, data, dataIndex) {
            //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            // }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-'+module+'-table-filter="search"]');

        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    // var handleFilterDatatable = () => {
    //     // Select filter options
    //     filterPayment = document.querySelectorAll('[data-kt-user-table-filter="payment_type"] [name="payment_type"]');
    //     const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');

    //     // Filter datatable on submit
    //     filterButton.addEventListener('click', function () {
    //         // Get filter values
    //         let paymentValue = '';

    //         // Get payment value
    //         filterPayment.forEach(r => {
    //             if (r.checked) {
    //                 paymentValue = r.value;
    //             }

    //             // Reset payment value if "All" is selected
    //             if (paymentValue === 'all') {
    //                 paymentValue = '';
    //             }
    //         });

    //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         dt.search(paymentValue).draw();
    //     });
    // }

    // Delete customer
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-'+module+'-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const recName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + recName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                            deleteData($(e.target).data('id'), dt);

                    } 
                });
            })
        });
    }

    var deleteData = (id, dt) => {

        $.ajax({
            type: 'DELETE',
            url: config.apiURL + module ,
            dataType:"JSON",
            data: {id: id},
            beforeSend:function(){


            },
            success:function(data){

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    dt.draw();
                });


            },
            error:function(xhr, ajaxOptions, thrownError){
                //parseErrors(xhr.responseText, globalFormId + '-msg')
            }
        });        

    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-'+module+'-table-filter="reset"]');

        // Reset datatable
//         resetButton.addEventListener('click', function () {
//             // Reset payment type
//             filterPayment[0].checked = true;
// 
//             // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
//             dt.search('').draw();
//         });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#'+module+'_listing');
        // const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-'+module+'-table-select="delete_selected"]');

        // Toggle delete selected toolbar
//         checkboxes.forEach(c => {
//             // Checkbox on click event
//             c.addEventListener('click', function () {
//                 setTimeout(function () {
//                     toggleToolbars();
//                 }, 50);
//             });
//         });
// 
//         // Deleted selected rows
//         deleteSelected.addEventListener('click', function () {
// 
//             // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
//             Swal.fire({
//                 text: "Are you sure you want to delete selected records?",
//                 icon: "warning",
//                 showCancelButton: true,
//                 buttonsStyling: false,
//                 showLoaderOnConfirm: true,
//                 confirmButtonText: "Yes, delete!",
//                 cancelButtonText: "No, cancel",
//                 customClass: {
//                     confirmButton: "btn fw-bold btn-danger",
//                     cancelButton: "btn fw-bold btn-active-light-primary"
//                 },
//             }).then(function (result) {
//                 if (result.value) {
//                     // Simulate delete request -- for demo purpose only
// 
//                         let ids = [];
//                         $(".rec-checkbox:checked").each(function() {
//                             ids.push(this.value);
//                         });                        
// 
//                         deleteData(ids, dt);
// 
//                         // Swal.fire({
//                         //     text: "You have deleted all selected records!.",
//                         //     icon: "success",
//                         //     buttonsStyling: false,
//                         //     confirmButtonText: "Ok, got it!",
//                         //     customClass: {
//                         //         confirmButton: "btn fw-bold btn-primary",
//                         //     }
//                         // }).then(function () {
//                         //     // delete row data from server and re-draw datatable
//                         //     dt.draw();
//                         // });
// 
//                         // Remove header checked box
//                         const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
//                         headerCheckbox.checked = false;
// 
//                 }
//             });
//         });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#'+module+'_listing');
        const toolbarBase = document.querySelector('[data-kt-'+module+'-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-'+module+'-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-'+module+'-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
//         let checkedState = false;
//         let count = 0;
// 
//         // Count checked boxes
//         allCheckboxes.forEach(c => {
//             if (c.checked) {
//                 checkedState = true;
//                 count++;
//             }
//         });
// 
//         // Toggle toolbars
//         if (checkedState) {
//             selectedCount.innerHTML = count;
//             toolbarBase.classList.add('d-none');
//             toolbarSelected.classList.remove('d-none');
//         } else {
//             toolbarBase.classList.remove('d-none');
//             toolbarSelected.classList.add('d-none');
//         }
    }

    // Public methods
    return {
        init: function () {

            initDatatable();
            handleSearchDatatable();
            initToggleToolbar();
            //handleFilterDatatable();
            handleDeleteRows();
            handleResetForm();
        }
    }
}();


var getDeactivatedListing = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var module = 'deactivated';

    // Private functions
    var initDatatable = function () {
        dt = $("#"+module+"_listing").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                // url: "https://preview.keenthemes.com/api/datatables.php",
                url: config.apiURL +'people/deactivated',

            },
            columns: [
                { data: 'name' },
                { data: 'date' },
                { data: 'reason' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function (data, type, row) {

                         return `${row.first_name} ${row.last_name}`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {

                         return `${row.status_date}`;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, row) {

                         return `${row.reason}`;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {

                        var banned = '';
                        var deleteHtml = '';

                            

                        return `<a href="javascript:void(0);" onclick="deletePeople(${row.id});" title="Delete Person" class="btn btn-icon btn-danger profile-btn"><i class="bi bi-trash-fill fs-4"></i></a>
                                <a href="javascript:void(0);" onclick="changePeopleStatus(${row.id}, 'Inactive', '${row.status}');" class="btn btn-icon btn-danger profile-btn"><i class="fa-solid fa-user-check" title="Activate"></i></a>
                                <a href="javascript:void(0);" onclick="changePeopleStatus(${row.id}, 'Banned', '${row.status}');" class="btn btn-icon btn-info profile-btn"><i class="fa-solid fa-ban" title="Ban Person"></i></a>
                                `;
                    },
                },
            ],
            // Add data-filter attribute
            // createdRow: function (row, data, dataIndex) {
            //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            // }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-'+module+'-table-filter="search"]');

        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    // var handleFilterDatatable = () => {
    //     // Select filter options
    //     filterPayment = document.querySelectorAll('[data-kt-user-table-filter="payment_type"] [name="payment_type"]');
    //     const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');

    //     // Filter datatable on submit
    //     filterButton.addEventListener('click', function () {
    //         // Get filter values
    //         let paymentValue = '';

    //         // Get payment value
    //         filterPayment.forEach(r => {
    //             if (r.checked) {
    //                 paymentValue = r.value;
    //             }

    //             // Reset payment value if "All" is selected
    //             if (paymentValue === 'all') {
    //                 paymentValue = '';
    //             }
    //         });

    //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         dt.search(paymentValue).draw();
    //     });
    // }

    // Delete customer
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-'+module+'-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const recName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + recName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                            deleteData($(e.target).data('id'), dt);

                    } 
                });
            })
        });
    }

    var deleteData = (id, dt) => {

        $.ajax({
            type: 'DELETE',
            url: config.apiURL + module ,
            dataType:"JSON",
            data: {id: id},
            beforeSend:function(){


            },
            success:function(data){

                Swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                    dt.draw();
                });


            },
            error:function(xhr, ajaxOptions, thrownError){
                //parseErrors(xhr.responseText, globalFormId + '-msg')
            }
        });        

    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-'+module+'-table-filter="reset"]');

        // Reset datatable
//         resetButton.addEventListener('click', function () {
//             // Reset payment type
//             filterPayment[0].checked = true;
// 
//             // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
//             dt.search('').draw();
//         });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#'+module+'_listing');
        // const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-'+module+'-table-select="delete_selected"]');

        // Toggle delete selected toolbar
//         checkboxes.forEach(c => {
//             // Checkbox on click event
//             c.addEventListener('click', function () {
//                 setTimeout(function () {
//                     toggleToolbars();
//                 }, 50);
//             });
//         });
// 
//         // Deleted selected rows
//         deleteSelected.addEventListener('click', function () {
// 
//             // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
//             Swal.fire({
//                 text: "Are you sure you want to delete selected records?",
//                 icon: "warning",
//                 showCancelButton: true,
//                 buttonsStyling: false,
//                 showLoaderOnConfirm: true,
//                 confirmButtonText: "Yes, delete!",
//                 cancelButtonText: "No, cancel",
//                 customClass: {
//                     confirmButton: "btn fw-bold btn-danger",
//                     cancelButton: "btn fw-bold btn-active-light-primary"
//                 },
//             }).then(function (result) {
//                 if (result.value) {
//                     // Simulate delete request -- for demo purpose only
// 
//                         let ids = [];
//                         $(".rec-checkbox:checked").each(function() {
//                             ids.push(this.value);
//                         });                        
// 
//                         deleteData(ids, dt);
// 
//                         // Swal.fire({
//                         //     text: "You have deleted all selected records!.",
//                         //     icon: "success",
//                         //     buttonsStyling: false,
//                         //     confirmButtonText: "Ok, got it!",
//                         //     customClass: {
//                         //         confirmButton: "btn fw-bold btn-primary",
//                         //     }
//                         // }).then(function () {
//                         //     // delete row data from server and re-draw datatable
//                         //     dt.draw();
//                         // });
// 
//                         // Remove header checked box
//                         const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
//                         headerCheckbox.checked = false;
// 
//                 }
//             });
//         });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#'+module+'_listing');
        const toolbarBase = document.querySelector('[data-kt-'+module+'-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-'+module+'-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-'+module+'-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
//         let checkedState = false;
//         let count = 0;
// 
//         // Count checked boxes
//         allCheckboxes.forEach(c => {
//             if (c.checked) {
//                 checkedState = true;
//                 count++;
//             }
//         });
// 
//         // Toggle toolbars
//         if (checkedState) {
//             selectedCount.innerHTML = count;
//             toolbarBase.classList.add('d-none');
//             toolbarSelected.classList.remove('d-none');
//         } else {
//             toolbarBase.classList.remove('d-none');
//             toolbarSelected.classList.add('d-none');
//         }
    }

    // Public methods
    return {
        init: function () {

            initDatatable();
            handleSearchDatatable();
            initToggleToolbar();
            //handleFilterDatatable();
            handleDeleteRows();
            handleResetForm();
        }
    }
}();





