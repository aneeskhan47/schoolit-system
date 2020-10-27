/*-----------------------------
* Build Your Plugin JS / jQuery
-----------------------------*/
/*
Jquery Ready!
*/
jQuery(document).ready(function($){
    "use strict";
    /*
    Add basic front-end page scripts here
    */
    /*
    *   Simple jQuery Click
    *
    *   Add id="mySpecialButton" to any element and when 
    *   clicked the same element will get the class "active".
    *
    */
   var base_url = ss_options.ss_website_url;
        
   $('.ss_admission_form_submit').on('click', function (e) {

    e.preventDefault();

    var lang = $('#ss_admission_form').attr("lang");

    // unblock when ajax activity stops 
    $(document).ajaxStop($.unblockUI); 

    $.blockUI(); 

    $.ajax({
    type: 'POST',
    url: base_url + 'api2/admission_form_submit/' + lang,
    data: $('#ss_admission_form').serialize(),
    success: function (response) {
        if(response.status == 0 && response.type == "validation_error"){
            $.each(response.body, function(key, value) {
                if (value.length !== 0) {
                    $('#input-' + key).addClass('is-invalid');
    
                $('#input-' + key).parents('.form-group').find('#error').html(value);
                }
                
            });
            $.each(response.custom_fields_errors,  function(key, value) { 
                if (value.length !== 0) {
                    var element = document.getElementById(key);
                    element.classList.add("is-invalid");
                    // $(custom_field_id).addClass('is-invalid');
    
                    $(element).parents('.form-group').find('.text-danger').html(value);
                }
            });
        
        }
        if(response.status == 1 && response.type == "success")
        Swal.fire(
            response.body.goodjob,
            response.body.message,
            'success'
          ).then((result) => {
            // Reload the Page
            location.reload();
          });

    }
    
});

});

   var class_id = $('#input-class_id').val();
   var section_id = '0';

   getSectionByClass(class_id, section_id);

   $(document).on('change', '#input-class_id', function (e) {
       $('#input-section_id').html("");
       var class_id = $(this).val();
       getSectionByClass(class_id, 0);
   });

   $('.date2').datetimepicker({
    timepicker: false,
    format:'d/m/Y',
    onSelectDate: function(){
        
if($("#input-dob").hasClass("is-invalid")){
    $("#input-dob").removeClass('is-invalid')
    $("#input-dob").parents('.form-group').find('#error').html("");
   }
      }
  });





   function getSectionByClass(class_id, section_id) {

       if (class_id !== "") {
           $('#input-section_id').html("");

           var div_data = '';
           

           $.ajax({
               type: "POST",
               url: base_url + "api2/getSections",
               data: {'class_id': class_id},
               dataType: "json",
               beforeSend: function () {
                   $('#input-section_id').addClass('dropdownloading');
               },
               success: function (data) {
                   $.each(data, function (i, obj)
                   {
                       var sel = "";
                       if (section_id === obj.section_id) {
                           sel = "selected";
                       }
                       div_data += "<option value=" + obj.id + " " + sel + ">" + obj.section + "</option>";
                   });
                   $('#input-section_id').append(div_data);
               },
               complete: function () {
                   $('#input-section_id').removeClass('dropdownloading');
               }
           });
       }
   }





function auto_fill_guardian_address() {
   if ($("#autofill_current_address").is(':checked'))
   {
       $('#current_address').val($('#input-guardian_address').val());
   }
}
function auto_fill_address() {
   if ($("#autofill_address").is(':checked'))
   {
       $('#permanent_address').val($('#current_address').val());
   }
}

$('input').on('input', function () {
    $(this).removeClass('is-invalid')
    $(this).parents('.form-group').find('#error').html("");

  });

  $('select').on('change', function () {
    $(this).removeClass('is-invalid')
    $(this).parents('.form-group').find('#error').html("");
    $(this).parents('.form-group').find('.text-danger').html("");
    $("#input-section_id").removeClass('is-invalid')
    $("#input-section_id").parents('.form-group').find('#error').html("");
  });  


$('input:radio[name="guardian_is"]').change(
       function () {
           if ($(this).is(':checked')) {
               var value = $(this).val();
               if (value === "father") {
                   $('#input-guardian_name').val($('#input-father_name').val());
                   $('#input-guardian_phone').val($('#input-father_phone').val());
                   $('#input-guardian_occupation').val($('#input-ather_occupation').val());
                   $('#input-guardian_relation').val("Father");
               } else if (value === "mother") {
                   $('#input-guardian_name').val($('#input-mother_name').val());
                   $('#input-guardian_phone').val($('#input-mother_phone').val());
                   $('#input-guardian_occupation').val($('#input-mother_occupation').val());
                   $('#input-guardian_relation').val("Mother");
               } else {
                   $('#input-guardian_name').val("");
                   $('#input-guardian_phone').val("");
                   $('#input-guardian_occupation').val("");
                   $('#input-guardian_relation').val("");
               }
           }
       });
    
    // End basic front-end scripts here
});