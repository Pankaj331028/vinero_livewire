// Class definition
var KTBootstrapDatepicker = function() {
    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }
    // Private functions
    var demos = function() {
        $('#end_date').datepicker({
            rtl: KTUtil.isRTL(),
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows
        });
        $('#start_date').datepicker({
            rtl: KTUtil.isRTL(),
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            // startDate: new Date()
        }).on('changeDate', function(date) {
            if (new Date($('#end_date').val()) < new Date(this.value)) $('#end_date').val('');
            $('#end_date').datepicker('setStartDate', new Date(this.value));
        });
        $('#month').datepicker({
            format: "mm-yyyy",
            startView: "months", 
            minViewMode: "months",
            orientation: "bottom left",
            templates: arrows
        });
    }
    return {
        // public functions
        init: function() {
            demos();
        }
    };
}();
jQuery(document).ready(function() {
    KTBootstrapDatepicker.init();
});