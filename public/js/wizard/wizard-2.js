"use strict";

// Class definition
var KTWizard2 = function() {
    // Base elements
    var wizardEl;
    var formEl;
    var validator;
    var wizard;

    // Private functions
    var initWizard = function() {
        // Initialize form wizard
        wizard = new KTWizard('kt_wizard_v2', {
            startStep: 1,
        });

        // // Validation before going to next page
        wizard.on('beforeNext', function(wizardObj) {
            /*if (validator.form() !== true) {
                wizardObj.stop(); // don't go to the next step
            }*/
        })

        // Change event
        wizard.on('change', function(wizard) {
            KTUtil.scrollTop();
        });
    }


    return {
        // public functions
        init: function() {
            wizardEl = KTUtil.get('kt_wizard_v2');
            formEl = $('#kt_form');

            initWizard();
            // initValidation();
            // initSubmit();
        }
    };
}();

jQuery(document).ready(function() {
    KTWizard2.init();
});
