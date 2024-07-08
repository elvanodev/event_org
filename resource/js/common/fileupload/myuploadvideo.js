    function imgopendialog(xidimagedialog){
    $(document).ready(function() {    
     $('#'+xidimagedialog).dialog("open");
     });
   }

(function( $ ) {
    
   $.fn.myuploadvideo = function() {
    var xidparent  = this.parent().attr('id');
    var xidelement = this.attr('id');
    var xcaptionupload = $('#'+xidelement).attr('alt');
    //alert(xidelement);
    var xform = '<div class="formupload">'+
                '<form id="upload'+xidelement+'" method="post" action="'+ getBaseURL()+'index.php/ctrfileupload/upload/" enctype="multipart/form-data">'+
                '          <div id="dropvideo" style="color:white;"> '+
                '                  '+                             
                '          '+                
                '            '+
                '            '+
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
        $("#dropvideo").html($('#'+xidelement).val());
    //alert($('#'+xidelement).val())
    // $('.previewvideo'+xidelement).attr({"target": getBaseURL()+"resource/uploaded/img/"+$('#'+xidelement).val()});
//     $("#dropvideo").html('<embed autoplay="no" type="application/x-vlc-plugin" pluginspage="http://www.videolan.org" width="100%" \n\
//                          height="100%" id="vlc" target="'+getBaseURL()+"resource/uploaded/img/"+$('#'+xidelement).val()+'"></embed>');
   });



  
    // Initialize the jQuery File Upload plugin
    $('#upload'+xidelement).fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#dropvideo'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
            
//            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
//                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');
//
//            // Append the file name and file size
//            tpl.find('p').text(data.files[0].name)
//                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');
//
//            // Add the HTML to the UL element
//            data.context = tpl.appendTo(ul);
//
//            // Initialize the knob plugin
//            tpl.find('input').knob();
//
//            // Listen for clicks on the cancel icon
//            tpl.find('span').click(function(){
//
//                if(tpl.hasClass('working')){
//                    jqXHR.abort();
//                }
//
//                tpl.fadeOut(function(){
//                    tpl.remove();
//                });
//
//            });
//
//            // Automatically upload the file once it is added to the queue
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