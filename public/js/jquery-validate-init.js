var fixedLength = 0;
jQuery.validator.addMethod("filesize_min", function(value, element, param) {
    var isOptional = this.optional(element),
        file;

    if (isOptional) {
        return isOptional;
    }

    if (param[2] < param[0] || param[3] < param[1]) {

        return false;
    } else {

        return true;
    }

}, function() {
    return "Please upload image with minimum dimensions specified";
});

jQuery.validator.addMethod("fixedDigits", function(value, element, param) {
    var isOptional = this.optional(element);
    fixedLength = param;

    if (isOptional) {
        return isOptional;
    }

    return ($(element).val().length <= param);
}, function() {
    return "Value cannot exceed " + fixedLength + " characters."
});

jQuery.validator.addMethod("extension", function(value, element, param) {
    param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif";
    return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
}, "Please select valid with a valid extension (.jpg, .jpeg, .png, .gif, .pdf)");

jQuery.validator.addMethod("docextension", function(value, element, param) {
    param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif";
    return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
}, "Please select file with a valid extension (.jpg, .jpeg, .png, .doc, .docx, .pdf)");

jQuery.validator.addMethod("decimalPlaces", function(value, element) {
    return this.optional(element) || /^\d+(\.\d{0,2})?$/i.test(value);
}, "Please enter a value with maximum two decimal places.");

jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9]+$/i.test(value);
}, "Please enter alphanumeric value.");

jQuery.validator.addMethod("alphanumericspace", function(value, element) {
    return this.optional(element) || /^[a-zA-Z\s0-9?]+$/i.test(value);
}, "Please enter alphanumeric value.");

jQuery.validator.addMethod("check_contenttext", function(value, el, param) {
    content = value.replace(/\s+/g, '');

    return (content !== "");
}, "Incorrect value");

jQuery.validator.addMethod("exactlength", function(value, element, param) {
    return this.optional(element) || value.length == param;
}, $.validator.format("Please enter exactly {0} characters."));

jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
}, "Name can have alphabets and space only.");

jQuery.validator.addMethod("correctPassword", function(value, element) {
    return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{6,}$/i.test(value);
}, "Please fill minimum 6 character Password with uppercase, lowercase, special character and digit");

jQuery.validator.addMethod("check_content", function(value, el, param) {
    var content = $(el).summernote('code');
    content = $(content).text().replace(/\s+/g, '');

    return (content !== "");
}, "Incorrect value");

jQuery.validator.addMethod("validate_email", function(value, element) {
    if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
        return true;
    } else {
        return false;
    }
}, "Please enter a valid Email.");


var form_validation = function() {
    var e = function() {
        jQuery(".form-valide").validate({
            ignore: [".note-editor *", "password"],
            errorClass: "invalid-feedback animated fadeInDown",
            errorElement: "div",
            errorPlacement: function(e, a) {
                jQuery(a).closest(".form-group").append(e)
            },
            highlight: function(e) {
                jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
                // jQuery(e).removeClass("is-invalid").addClass("is-invalid")
            },
            success: function(e) {
                jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
                // jQuery(e).removeClass("is-invalid"), jQuery(e).remove()
            },

            rules: {
                "first_name": {
                    required: !0,
                },
                "last_name": {
                    required: !0,
                },
                "status": {
                    required: !0,
                },
                "email": {
                    required: !0,
                },
                "comment_note": {
                    required: !0,
                },
            },
            messages: {
            }
        })
    }
    return {
        init: function() {
            e(), jQuery(".js-select2").on("change", function() {
                jQuery(this).valid()
            })
        }
    }
}();

jQuery(function() {
    form_validation.init()
});