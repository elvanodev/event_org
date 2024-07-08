//function file_get_ext(filename)
//{
//    return typeof filename != "undefined" ? filename.substring(filename.lastIndexOf(".") + 1, filename.length).toLowerCase() : false;
//}
//
//
//function imgopendialog(xidimagedialog) {
//    $(document).ready(function() {
//        $('#' + xidimagedialog).dialog("open");
//    });
//}
//
//function setfileberhasil(namafile, ext) {
//    $(document).ready(function() {
//        $.ajax({
//            url: getBaseURL() + "index.php/ctrfileupload/isfileada/",
//            data: "namafile=" + namafile + "&ext=" + ext,
//            cache: false,
//            dataType: 'json',
//            type: 'POST',
//            async: false,
//            success: function(json) {
//                //alert(json.isberhasil+'--'+namafile);
//
//                if (json.isberhasil) {
//
//                    $('#edidjenisdokumen').val(json.idext);
//                    $('#drop').html('File :' + json.file + ' Berhasil Di Upload');
//                } else {
//                    $('#edidjenisdokumen').val(0);
//                    $('#drop').html('FILE ' + json.file + ' GAGAL DI UPLOAD <br /> 1. perhatikan  Nama File <br /> 2. Jenis File yang di ijinkan');
//                }
//            },
//            error: function(xmlHttpRequest, textStatus, errorThrown) {
//                alert("Error juga " + xmlHttpRequest.responseText);
//            }
//        });
//    });
//}
//
//(function($) {
//
//    $.fn.myupload = function() {
//        var xidparent = this.parent().attr('id');
//        var xidelement = this.attr('id');
//        var xcaptionupload = $('#' + xidelement).attr('alt');
//        //alert(xidelement);
//
//        var xform = '<div class="formupload">' +
//                '<form id="upload' + xidelement + '" method="post" action="' + getBaseURL() + 'index.php/ctrfileupload/upload/" enctype="multipart/form-data">' +
//                '          <div id="drop">' +
//                '         <img src="" class="previewimage' + xidelement + '" onclick="imgopendialog(\'gbrdialog' + xidelement + '\');" style="cursor:pointer;width:100%;height:100%;"/>' +
//                '            <div id="gbrdialog' + xidelement + '">' +
//                '                 <img src="" class="previewimage' + xidelement + '" style="width:100%;height:100%;"/>' +
//                '             </div>' +
//                '          </div>' +
//                '             <a id="a' + xidelement + '">' + xcaptionupload + '</a>' +
//                '               <input type="file" name="upl"  />' +
//                '             <ul>' +
//                '            </ul>' +
//                '       </div>' +
//                '      </form>';
//
//        $('#' + xidelement).hide();
//
//        $('#' + xidparent).append(xform);
//
//        var ul = $('#upload' + xidelement + ' ul');
//
//        $('#a' + xidelement + '').click(function() {
//            // Simulate a click on the file input button
//            // to show the file browser dialog
//            $(this).parent().find('input').click();
//        });
//
//        $('#gbrdialog' + xidelement).dialog({
//            autoOpen: false,
//            height: 600,
//            width: 500,
//            zIndex: 5000,
//            modal: true
//        });
//
//        $('#' + xidelement).change(function() {
//            // alert($('#'+xidelement).val())
//            xfile = $('#' + xidelement).val();
//            xExt = file_get_ext(xfile);
//            /*
//             ArrayExt = new Array('doc','docx','xls','xlsx','pdf');
//             if(ArrayExt.indexOf(xExt.toLowerCase())!=-1){
//             $('#drop').html(' File : '+"\n"+$('#'+xidelement).val()+"\n"+' Berhasil Di Upload');       
//             } else{
//             $('.previewimage'+xidelement).attr({"src": getBaseURL()+"resource/uploaded/file/"+$('#'+xidelement).val()});
//             }
//             */
//        });
//
//
//
//
//        // Initialize the jQuery File Upload plugin
//        $('#upload' + xidelement).fileupload({
//            // This element will accept file drag/drop uploading
//            dropZone: $('#drop'),
//            // This function is called when a file is added to the queue;
//            // either via the browse button, or via drag/drop:
//            add: function(e, data) {
//
////            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
////                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');
////
////            // Append the file name and file size
////            tpl.find('p').text(data.files[0].name)
////                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');
////
////            // Add the HTML to the UL element
////            data.context = tpl.appendTo(ul);
////
////            // Initialize the knob plugin
////            tpl.find('input').knob();
////
////            // Listen for clicks on the cancel icon
////            tpl.find('span').click(function(){
////
////                if(tpl.hasClass('working')){
////                    jqXHR.abort();
////                }
////
////                tpl.fadeOut(function(){
////                    tpl.remove();
////                });
////
////            });
////
////            // Automatically upload the file once it is added to the queue
//                var jqXHR = data.submit();
//
//
//
//
//
//            },
//            progress: function(e, data) {
//
//                // Calculate the completion percentage of the upload
//                var progress = parseInt(data.loaded / data.total * 100, 10);
//
//                // Update the hidden input field and trigger a change
//                // so that the jQuery knob plugin knows to update the dial
//                //      data.context.find('input').val(progress).change();
//
//                if (progress == 100) {
//                    //   data.context.removeClass('working');
//                    $('#' + xidelement).val(data.files[0].name).trigger('change');
//                }
//            },
//            done: function(e, data) {
//                namafile = data.files[0].name;
//                ext = file_get_ext(namafile);
//                setfileberhasil(namafile, ext);
//
//
//            },
//            fail: function(e, json) {
//                // Something has gone wrong!
//                //    data.context.addClass('error');
//
//            }
//
//        });
//
//
//        // Prevent the default action when a file is dropped on the window
//        $(document).on('drop dragover', function(e) {
//            e.preventDefault();
//        });
//
//        // Helper function that formats the file sizes
//
//        function formatFileSize(bytes) {
//            if (typeof bytes !== 'number') {
//                return '';
//            }
//
//            if (bytes >= 1000000000) {
//                return (bytes / 1000000000).toFixed(2) + ' GB';
//            }
//
//            if (bytes >= 1000000) {
//                return (bytes / 1000000).toFixed(2) + ' MB';
//            }
//
//            return (bytes / 1000).toFixed(2) + ' KB';
//        }
//
//
//    }
//
//}(jQuery));

    function file_get_ext(filename)
    {
    return typeof filename != "undefined" ? filename.substring(filename.lastIndexOf(".")+1, filename.length).toLowerCase() : false;
    }


    function imgopendialog(xidimagedialog){
    $(document).ready(function() {    
     $('#'+xidimagedialog).dialog("open");
     });
   }
   
   function setfileberhasil(namafile, ext) {
    $(document).ready(function() {
        $.ajax({
            url: getBaseURL() + "index.php/ctrfileupload/isfileada/",
            data: "namafile=" + namafile + "&ext=" + ext,
            cache: false,
            dataType: 'json',
            type: 'POST',
            async: false,
            success: function(json) {
                //alert(json.isberhasil+'--'+namafile);

                if (json.isberhasil) {

                    $('#edidjenisdokumen').val(json.idext);
                    $('#drop').html('File :' + json.file + ' Berhasil Di Upload');
                } else {
                    $('#edidjenisdokumen').val(0);
                    $('#drop').html('FILE ' + json.file + ' GAGAL DI UPLOAD <br /> 1. perhatikan  Nama File <br /> 2. Jenis File yang di ijinkan');
                }
            },
            error: function(xmlHttpRequest, textStatus, errorThrown) {
                alert("Error juga " + xmlHttpRequest.responseText);
            }
        });
    });
}

(function($) {

    $.fn.myupload = function() {
        var xidparent = this.parent().attr('id');
        var xidelement = this.attr('id');
        var xvalueelement= $(this).val();
        var xcaptionupload = $('#' + xidelement).attr('alt');
        
        var xsrc = getBaseURL()+'resource/imgbtn/logo.png';
        if(xvalueelement!=''){
            var xsrc = getBaseURL()+'resource/uploaded/img/'+xvalueelement;
        }
    var xform = '<div class="formupload">'+
                '<form id="upload'+xidelement+'" method="post" action="'+ getBaseURL()+'index.php/ctrfileupload/upload/" enctype="multipart/form-data">'+
//                '          <div id="drop">'+
                '          <div id="drop'+xidelement+'">'+
                '         <img src="'+xsrc+'"  class="previewimage'+xidelement+'" onclick="imgopendialog(\'gbrdialog'+xidelement+'\');" style="cursor:pointer;width:100%;height:100%;"/>'+
                '            </div>'+
                '            <div id="gbrdialog'+xidelement+'">'+
                '                 <img src="" class="previewimage'+xidelement+'" style="width:100%;height:100%;"/>'+
                '             </div>'+
//                '          </div>'+
                '          <div id="loader'+xidelement+'"><span class="bar"></span></div>'+
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
     ArrayExt = new Array('png','jpg','jpeg','gif','pdf');
     if(ArrayExt.indexOf(xExt.toLowerCase())!=-1){
        /*  $('#drop').html(' File : '+"\n"+$('#'+xidelement).val()+"\n"+' Berhasil Di Upload');      */ 
         //$('#drop'+xidelement).html();
           //$('#drop'+xidelement).html('<img src="'+getBaseURL()+"resource/image/"+$('#'+xidelement).val()+'?'+new Date().getTime()+'" class="previewimage'+xidelement+'" onclick="imgopendialog(\'gbrdialog'+xidelement+'\');" style="cursor:pointer;width:100%;height:100%;"/>');
            $('.previewimage'+xidelement).attr({"src": getBaseURL()+"resource/uploaded/img/"+$('#'+xidelement).val()+'?'+new Date().getTime()});
             
	 }  
     
   });



  
    // Initialize the jQuery File Upload plugin
    $('#upload'+xidelement).fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),

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
            $('#loader'+xidelement+' .bar').css(
            'width',
            progress + '%'
        );
            if(progress == 100){
               
             //   data.context.removeClass('working');
             
           $('#'+xidelement).val(data.files[0].name).trigger('change');
            
            }
            
            
        },
         done:function(e, data){
            $('.previewimage'+xidelement).attr({"src": getBaseURL()+"resource/uploaded/img/"+$('#'+xidelement).val()+'?'+new Date().getTime()});
              $('#loader'+xidelement+' .bar').css(
            'width','0px'
        );
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