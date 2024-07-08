/* 
 
 * dinggo To change this template, choose Tools | Templates
 
 * and open the template in the editor.
 
 */



$(document).ready(function () {

    function addMCE()

    {



//        tinyMCE.execCommand('mceRemoveControl', false, 'id_news_text');
        tinymce.execCommand('mceRemoveEditor', false, 'id_news_text');//forn tinymce 4
        tinyMCE.init({

            theme: 'medium',

            mode: 'none'

        });

//        tinyMCE.execCommand('mceAddControl', false, 'id_news_text');
        tinymce.execCommand('mceAddEditor', false, 'id_news_text');//forn tinymce 4

    }





    $("textarea.tinymce").tinymce({

        script_url: getBaseURL() + "resource/js/tiny_mce/tinymce.min.js",
        theme: 'silver',
        width: 800,
        height: 500,
        plugins: [
            'advlist link image lists charmap preview hr anchor pagebreak',
            'visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
            'save table contextmenu paste textcolor fullpage'
        ],
        link_class_list: [
            {title: 'Choose the page', value: ''},
            {title: 'Program', value: 'program'},
            {title: 'Event', value: 'event'},
            {title: 'Residency', value: 'residency'},
            {title: 'Publication', value: 'publication'},
            {title: 'News', value: 'news'}
        ],
//        plugins: [
//            'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
//            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
//            'save table contextmenu directionality emoticons template paste textcolor fullpage'
//        ],
//        content_css: 'css/content.css',
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview media fullpage | forecolor backcolor',
//        entity_encoding: "raw",
        link_context_toolbar: true,
        link_assume_external_targets: true,
        relative_urls: true,
        convert_urls: false,
        fix_list_elements: true,
        forced_root_block: 'p',
        remove_trailing_brs: false,
        extended_valid_elements: "a[onclick|class|href|target=_blank],script[charset|defer|language|src|type],style,script[async|charset|defer|src|type|id]",
        valid_children: "+body[style],+body[script],+div[link],+body[div],+body[p]",
        schema: 'html5',
        inline: false, cleanup: true,
//        images_upload_url: getBaseURL() + 'index.php/uploadimage',
//        images_upload_base_path: './../../resource/uploaded/',
        images_upload_credentials: true,
        /* we override default upload handler to simulate successful upload*/
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', getBaseURL() + 'index.php/uploadimage');

            xhr.onload = function () {
                var json;

                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                success(json.location);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

//            formData.append('directory', './../../resource/uploaded/');
            xhr.send(formData);
        },
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        }
    });

});





function ajaxfilemanager(field_name, url, type, win) {

    //var ajaxfilemanagerurl = "../../../resource/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";

    //var ajaxfilemanagerurl = getBaseURL()+"resource/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";

    var ajaxfilemanagerurl = getBaseURL() + "resource/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";

    switch (type) {

        case "image":

            break;

        case "media":

            break;

        case "flash":

            break;

        case "file":

            break;

        default:

            return false;

    }



    tinyMCE.activeEditor.windowManager.open({

        // url: "../../../resource/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php",

        //url: getBaseURL()+"resource/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php",

        url: getBaseURL() + "resource/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php",

        width: 700,

        height: 540,

        inline: "yes",

        modal: true,

        close_previous: "no",

        overlay: {

            backgroundColor: "#000000",

            opacity: .75

        },

        open: function () {

            setTimeout('addMCE()', 2000);

        },

        beforeclose:
                function () {

                    tinyMCE.execCommand('mceRemoveControl', false, 'id_news_text');

                }



    }, {

        window: win,

        input: field_name

    });





}


$('#btSimpan').click(function () {
    tinyMCE.triggerSave();

});
