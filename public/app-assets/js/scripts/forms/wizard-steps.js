/*=========================================================================================
    File Name: wizard-steps.js
    Description: wizard steps page specific js
    ----------------------------------------------------------------------------------------
    Item Name: Vuesax HTML Admin Template
    Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/



let form = $("#videoForm");
    form.validate({
    ignore: 'input[type=hidden]',
    errorClass: 'danger',
    successClass: 'success',
    errorPlacement: function(error, element) {
        error.insertAfter(element);
    },
    highlight: function(element) {
        form.addClass('was-validated');
    },
    unhighlight: function(element) {
        form.addClass('was-validated');
    },
    success: function(label, element) {
        form.addClass('was-validated');
    },
    submitHandler: function(form) {

    },
    rules: {}
});

// Wizard tabs with icons setup
$(".icons-tab-steps").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onStepChanging: function (event, currentIndex, newIndex) {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex) {
            return true;
        }

        // Needed in some cases if the Users went back (clean up)
        if (currentIndex < newIndex) {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }

        if (currentIndex === 2) {
            if( $('#slidesAccordion .collapse-margin').length < 1 ){
                $(".icons-tab-steps").steps("setStep", 1);
                alert('You must add products!');
            }
        }

        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex) {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex) {
        // alert("Submitted!");
        form[0].submit();
    }
});



$(document).on('click', '#pills .finish a', function(){
    if ($('#videoSource').val() == 'mp4') {
        if( $('#playerThumbnail').val() == '' ) {
            alert('Please select the player thumbnail image;');
            return false;
        } else {
            form[0].submit();
        }
    } else {
        form[0].submit();
    }
});
