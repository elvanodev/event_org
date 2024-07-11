//Call usable js function
$(document).ready(function () {
    formatrupiah();
    settanggal();
    declarecustomtooltip();
    $(".datetimepicker").each(function () {
        $(this).datetimepicker();
    });
});

function declarecustomtooltip() {
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    $('.custom-tooltip').on( "click", function(){
        $("#tooltipmessage").html($(this).data('tooltipmessage'));
        $("#tooltipmodal").show();
    });
    $('.closetooltipmodal').on( "click", function(){
        $("#tooltipmessage").html("");
        $("#tooltipmodal").hide();
    });
}

//Format Rupiah
function formatCurrencyAll() {
    formatCurrency($("input[data-type='currency']"));
}
function formatrupiah() {
    $("input[data-type='currency']").on({
        focus: function () {
            formatCurrency($(this));
        },
        keyup: function () {
            formatCurrency($(this));
        },
        blur: function () {
            formatCurrency($(this));
        }
    });
}
function formatNumber(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}
function formatCurrency(input, blur) {
    var input_val = input.val();
    if (input_val === "") { return; }
    var original_len = input_val.length;
    //var caret_pos = input.prop("selectionStart");
    if (input_val.indexOf(".") >= 0) {
        var decimal_pos = input_val.indexOf(".");
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);
        left_side = formatNumber(left_side);
        left_side = removeLeadingZerosRegex(left_side);
        right_side = formatNumber(right_side);
        right_side = right_side.substring(0, 2);
        input_val = "Rp" + left_side + "." + right_side;

    } else {
        input_val = formatNumber(input_val);
        input_val = removeLeadingZerosRegex(input_val);
        input_val = "Rp" + input_val;
    }
    input.val(input_val);

    var updated_len = input_val.length;
    //caret_pos = updated_len - original_len + caret_pos;
    //input[0].setSelectionRange(caret_pos, caret_pos);
}
function removeLeadingZerosRegex(str) {
    return str.replace(/^0+(?=\d)/, '');
}
function removecurrencyformat(currency) {
    var numberPattern = /[+-]?\d+(\.\d+)?/g;
    return currency.match( numberPattern ).join('');
}

//Tanggal
function strpad(val) {
    return (!isNaN(val) && val.toString().length == 1) ? "0" + val : val;
}
function settanggal() {
    $(document).ready(function () {

        var currentTimeAndDate = new Date();
        var Date30 = new Date();
        var date = new Date();
        Date30.setDate(Date30.getDate() - 30);

        var dd = date.getDate();
        var mm = date.getMonth();
        var yy = date.getYear();

        var hh = date.getHours();
        var mnt = date.getMinutes();

        var dd30 = Date30.getDate();
        var mm30 = Date30.getMonth();
        var yy30 = Date30.getYear();

        yy = (yy < 1000) ? yy + 1900 : yy;
        yy30 = (yy30 < 1000) ? yy30 + 1900 : yy30;

        $(".tanggal").datepicker({
            dateFormat: 'dd-mm-yy'
        });

        $(".tanggal").val(strpad(dd) + "-" + strpad(mm + 1) + "-" + yy);

    });
}

//preview image
function previewimage(ximage){
    $(document).ready(function () {
    $('#dialogtitle').html("Preview Image");
    $('#dialogdata').html('<img src="'+ximage+'" class="img-responsive" >');
    $('#showmodal').modal("show");
   
    });
}

//dropdown status properti
function dropdownstatusproperti(editedstatus, modul, statuselement) {
    $(document).ready(function () {
      $.ajax({
        url: getBaseURL() + "index.php/ctr"+modul+"/dropdownstatusproperti"+modul+"/",
        data: "editedstatus=" + editedstatus,
        cache: false,
        dataType: 'json',
        type: 'POST',
        async: false,
        success: function (json) {
            statuselement.html("");
            statuselement.html(json.option);
            statuselement.prop("disabled", json.disabled);
            statuselement.val(editedstatus);
  
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
          alert("Error juga " + xmlHttpRequest.responseText);
        }
      });
    });
  }
  
function validateform() {
// Fetch all the forms we want to apply custom Bootstrap validation styles to
var forms = document.querySelectorAll('.needs-validation');

// Loop over them and prevent submission
Array.prototype.slice.call(forms)
    .forEach(function (form) {
    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false)
    });
}

function onchangeoptionselect(repid,rowindex) {
    var element = $('#edjenisalatkerja_'+ repid +'_'+rowindex);
    var buttontooltip = $('#btntooltip_'+ repid +'_'+rowindex);
    var message = element.find(':selected').attr('data-tooltipmessage');
    console.log("onchangeoptionselect", message);
    if (message) {
        buttontooltip.show();
    } else {
        buttontooltip.hide();
    }
}

function onclickshowoptiontooltip(repid,rowindex) {
    var element = $('#edjenisalatkerja_'+ repid +'_'+rowindex);
    var message = element.find(':selected').attr('data-tooltipmessage');
    var title = element.find(':selected').attr('data-title');
    if (message) {
        $("#tooltipmessage").html(message);
        $(".modal-title").html(title);
        $("#tooltipmodal").show();
    }
}
  