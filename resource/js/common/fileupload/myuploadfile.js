    function file_get_ext(filename)
    {
    return typeof filename != "undefined" ? filename.substring(filename.lastIndexOf(".")+1, filename.length).toLowerCase() : false;
    }


    function imgopendialog(xidimagedialog){
    $(document).ready(function() {    
     $('#'+xidimagedialog).dialog("open");
     });
   }
   
 
(function($) {

    $.fn.myuploadfile = function() {
        var xidparent = this.parent().attr('id');
        var xidelement = this.attr('id');
        var xcaptionupload = $('#' + xidelement).attr('alt');
    //alert(xidelement);
    
    var xform = '<div class="formupload">'+
                '<form id="upload'+xidelement+'" method="post" action="'+ getBaseURL()+'index.php/ctrfiluploadfile/upload/" enctype="multipart/form-data">'+
                '          <div id="drop">'+
                '         <img src="" class="previewimage'+xidelement+'" onclick="imgopendialog(\'gbrdialog'+xidelement+'\');" style="cursor:pointer;width:100%;height:100%;"/>'+
                '            <div id="gbrdialog'+xidelement+'">'+
                '                 <img src="" class="previewimage'+xidelement+'" style="width:100%;height:100%;"/>'+
                '             </div>'+
                '          </div>'+
                '             <a id="a'+xidelement+'">'+xcaptionupload+'</a>'+
                '               <input type="file" name="upl"  />'+
                '             <ul>'+
                '            </ul>'+
                '       </div>'+
                '      </form>';

    $('#'+xidelement).hide();
    
    $('#'+xidparent).append(xform);

    var ul = $('#upload'+xidelement+' ul');

    $('#a'+xidelement+'').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    $('#gbrdialog'+xidelement).dialog({
            autoOpen: false,
            height: 600,
            width: 500,
            zIndex: 5000,
            modal: true
        });

    $('#'+xidelement).change(function() {
   // alert($('#'+xidelement).val())
     xfile = $('#'+xidelement).val();
     xExt = file_get_ext(xfile);
     ArrayExt = new Array('doc','docx','xls','xlsx','pdf');
     if(ArrayExt.indexOf(xExt.toLowerCase())!=-1){
         $('#drop').html(' File : '+"\n"+$('#'+xidelement).val()+"\n"+' Berhasil Di Upload');       
     } else{
             $('.previewimage'+xidelement).attr({"src": getBaseURL()+"resource/uploaded/file/"+$('#'+xidelement).val()});
       }
     
   });
    $('#upload'+xidelement).fileupload({


        dropZone: $('#drop'),
        add: function (e, data) {

            var jqXHR = data.submit();
            
           // alert(data.files[0].name);
            
            
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
      //      data.context.find('input').val(progress).change();

            if(progress == 100){
             //   data.context.removeClass('working');
            $('#'+xidelement).val(data.files[0].name).trigger('change');
            }
        },

        fail:function(e, data){
            // Something has gone wrong!
        //    data.context.addClass('error');
        }

    });

  
    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes

    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }


   }
  
}( jQuery ));