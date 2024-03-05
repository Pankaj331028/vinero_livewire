window.addEventListener('show-success', event => {
    $('html,body').animate({
        scrollTop: $('#successAlert').offset().top - 200
    })
});
window.addEventListener('show-error', event => {
    $('html,body').animate({
        scrollTop: $('#errorAlert').offset().top - 200
    })
});
window.addEventListener('error-result', event => {
    var first = $('.is-invalid:first');
    if (first.length > 0 && first != undefined && first != null) {

        var elem = first.closest('.form-group');

        if (elem.length <= 0) {
            elem = first.closest('.form-control');
        }
        if (elem.length <= 0) {
            elem = first.closest('.feedback-input');
        }

        $('html,body').animate({
            scrollTop: elem.offset().top - 200
        })
    }
});
$(document).on('keyup', ".decimalInput, .numberInput", function(e) {
    if ($(this).val().indexOf('-') >= 0) {
        $(this).val($(this).val().replace(/\-/g, ''));
    }
})

if ($(document).find(".numberInput").length > 0)
    $(document).find(".numberInput").maskAsNumber({
        receivedMinus: false
    });

if ($(document).find(".decimalInput").length > 0)
    $(document).find(".decimalInput").maskAsNumber({
        receivedMinus: false,
        decimals: 6
    });


$(document).on('click', '.deleteBtn', function() {
    var href = $(this).attr('href');
    event.preventDefault(); //this will hold the url
    swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then(function(result) {
        if (result.value) {
            window.location.href = href;
        }
    });
});

$(document).find('.alert').delay(5000).fadeOut();

$(document).on('click', '.dblclick', function() {
    return false;
});

$(document).on('dblclick', '.dblclick', function() {
    window.location = this.href;
    return false;
});

// jQuery(document).find('.phoneNumber').inputmask({"mask": "999 999 9999"});

// $(document).find('.numberSystem').maskNumber({ integer: true });

/*$(document).on('blur', '.numberSystem', function() {
    var num = parseFloat($(this).val());

    // $(this).val(num.toLocaleString("en-US"));
})*/
document.addEventListener('update-item', function () {
    $(".numberSystem").each(function(){
        formatCurrency($(this), "blur");    
    });
    var im = new Inputmask({"mask":"999-999-9999","showMaskOnHover":false,"showMaskOnFocus":true}); 
    im.mask('.phoneNumber');
});

$(".numberSystem").on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
    }
});


function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function formatCurrency(input, blur) { 
   
  var input_val = input.val(); 
  if (input_val === "") { return; }
  var original_len = input_val.length;
  var caret_pos = input.prop("selectionStart");

  if (input_val.indexOf(".") >= 0) {

    var decimal_pos = input_val.indexOf(".");

    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    left_side = formatNumber(left_side);

    right_side = formatNumber(right_side);

    right_side = right_side.substring(0, 2);
    input_val = "$" + left_side + "." + right_side;

  } else {
    input_val = formatNumber(input_val);
    input_val = "$" + input_val; 
  }

  input.val(input_val);
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}

     
var im = new Inputmask({"mask":"999-999-9999","showMaskOnHover":false,"showMaskOnFocus":true}); 
im.mask('.phoneNumber');



function viewPassword(id, id2){
    var passwordInput = document.getElementById(id)
  ;
    var passStatus = document.getElementById(id2);
    if (passwordInput.type == 'password'){
      passwordInput.type='text';
      passStatus.src='web/img/invisible.png';
      
    }else{
      passwordInput.type='password';
      passStatus.src='web/img/visible.png';
    }
}