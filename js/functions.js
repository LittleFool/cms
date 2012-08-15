//<![CDATA[
$(function(){
    var dropbox = $('#dropbox'),
    message = $('.message', dropbox);
	
    dropbox.filedrop({
        // The name of the $_FILES entry:
        paramname:'pic',
		
        maxfiles: 5,
        maxfilesize: 2,
        url: 'post_file.php',
		
        uploadFinished:function(i,file,response){
            $.data(file).addClass('done');
        // response is the JSON object that post_file.php returns
        },
		
        error: function(err, file) {
            switch(err) {
                case 'BrowserNotSupported':
                    showMessage('Ihr Browser unterstützt kein HTML5. Benutzen Sie bitte FireFox, Chrome oder Opera!');
                    break;
                case 'TooManyFiles':
                    alert('Zu viele Dateien gleichzeitig, maximal erlaubt sind 5!');
                    break;
                case 'FileTooLarge':
                    alert(file.name+' ist zu groß! Maximale Dateigröße ist 2MB.');
                    break;
                default:
                    break;
            }
        },
		
        // Called before each upload is started
        beforeEach: function(file){
            if(!file.type.match(/^image\//)){
                alert('Es sind nur Bilder erlaubt!');
				
                // Returning false will cause the
                // file to be rejected
                return false;
            }
        },
		
        uploadStarted:function(i, file, len){
            createImage(file);
        },
		
        progressUpdated: function(i, file, progress) {
            $.data(file).find('.progress').width(progress);
        }
    	 
    });
	
    var template = '<div class="preview">'+
    '<span class="imageHolder">'+
    '<img />'+
    '<span class="uploaded"></span>'+
    '</span>'+
    '<div class="progressHolder">'+
    '<div class="progress"></div>'+
    '</div>'+
    '</div>'; 
	
	
    function createImage(file){

        var preview = $(template), 
        image = $('img', preview);
			
        var reader = new FileReader();
		
        image.width = 100;
        image.height = 100;
		
        reader.onload = function(e){
			
            // e.target.result holds the DataURL which
            // can be used as a source of the image:
			
            image.attr('src',e.target.result);
        };
		
        // Reading the file as a DataURL. When finished,
        // this will trigger the onload function above:
        reader.readAsDataURL(file);
		
        message.hide();
        preview.appendTo(dropbox);
		
        // Associating a preview container
        // with the file, using jQuery's $.data():
		
        $.data(file,preview);
    }

    function showMessage(msg){
        message.html(msg);
    }

});

$().ready(function() {
    $('textarea.tinymce').tinymce({
        // Location of TinyMCE script
        script_url : 'js/tiny_mce/tiny_mce.js',

        // General options
        theme : "advanced",
        plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "save,|,bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect,|,visualblocks,code",
        theme_advanced_buttons2 : "search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup",
        theme_advanced_buttons4 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Example content CSS (should be your site CSS)
        //content_css : "css/styles.css",
        
        // Schema is HTML5 instead of default HTML4
        schema: "html5",

        // End container block element when pressing enter inside an empty block
        end_container_on_empty_block: true,

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "lists/template_list.js",
        external_link_list_url : "lists/link_list.js",
        external_image_list_url : "lists/image_list.js",
        media_external_list_url : "lists/media_list.js"
    });
});
//]]>