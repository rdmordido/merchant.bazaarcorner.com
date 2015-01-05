
var bc_fileupload = function(){
    var self = this;

    this.init_fileupload = function (){

        self.init_fileupload_actions();

        $('#upload_item_image').fileupload({
            dataType        : 'json',
            autoUpload      : true,
            acceptFileTypes : /(\.|\/)(gif|jpe?g|png)$/i,
            maxFileSize     : 5000000, // 5 MB
            previewMaxWidth : 100,
            previewMaxHeight: 100,
            previewCrop     : true
        }).on('fileuploadadd',function(e,data){
            //fileuploadadd
        }).on('fileuploadprocessalways',function(e,data){
            //fileuploadprocessalways
        }).on('fileuploadprogressall',function(e,data){
            
                $('#fileupload-progress').show();
                var progress    = parseInt(data.loaded / data.total * 100, 10);
                $('#fileupload-progress .progress-bar').css('width',progress + '%');
                
                if(progress == 100){
                    $('#fileupload-progress').hide();
                    $('#fileupload-progress .progress-bar').css('width','0%');  
                }
        }).on('fileuploaddone',function(e,data){
            var html = "";
            $('#item-image-error').hide()
            $('#fileupload-delete-all').show();
            $.each(data.result.files, function (index, file) {
                if(file.url){
                    
                    display_style = '';
                    if($('.fileupload-item').length == 0 && index == 0){
                        $('#item_primary_image').val(file.name);
                        display_style = 'display:none;'
                    }

                    html += '<tr class="fileupload-item template-upload fade in">';
                    html += '<td><span class="preview">';
                    html += '<img src="'+file.thumbnailUrl+'" width="80" height="45"/></span></td>';
                    html += '<td>';
                    html += '<input name="item_images[]" class="image-name" type="hidden" value="'+file.name+'">';
                    html += '<p class="name">'+file.realName+'</p>';
                    html += '<strong class="error text-danger"></strong>';
                    html += '</td>';
                    html += '<td>';
                    html += '<button type="button" class="btn-set-as-primary btn btn-sm btn-info" style="'+display_style+'" style="cursor:pointer;">';
                    html += '<i class="glyphicon glyphicon-ok"></i>';
                    html += '<span>Set as Primary</span>';
                    html += '</td>';
                    html += '<td>';
                    html += '<button type="button" class="btn-delete-fileupload btn btn-sm btn-danger delete" delete-url="'+file.deleteUrl+'" style="cursor:pointer;">';
                    html += '<i class="glyphicon glyphicon-trash"></i>';
                    html += '<span>Delete</span>';
                    html += '</button>';
                    html += '</td>';
                    html += '</tr>';

                    $('#uploaded_images').append(html);
                    self.init_fileupload_actions();
                }
            });
        }).on('fileuploadfail',function(e,data){
            //fileuploadfail
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');

    $('#upload-item-video').fileupload({
            dataType        : 'json',
            autoUpload      : true,
            acceptFileTypes : /(\.|\/)(mp4|avi|flv|mov|wmv)$/i,
            maxFileSize     : 25000000, // 5 MB
            previewMaxWidth : 100,
            previewMaxHeight: 100,
            previewCrop     : true
        }).on('fileuploadprogressall',function(e,data){
            
                $('#fileupload-progress').show();
                var progress    = parseInt(data.loaded / data.total * 100, 10);
                $('#fileupload-progress .progress-bar').css('width',progress + '%');
                
                if(progress == 100){
                    $('#fileupload-progress').hide();
                    $('#fileupload-progress .progress-bar').css('width','0%');  
                }
        }).on('fileuploaddone',function(e,data){

            $.each(data.result.files, function (index, file) {
                if(file.url){
                    $('#item_video').val(file.name);
                    $('#item-video-preview').attr('src',file.thumbnailUrl)
                    $('#delete-item-video').attr('delete-url',file.deleteUrl);
                    $('#delete-item-video').show();
                    $('#upload-item-video').parent().find('span').text('Replace Video');
                }
            });

        });

    $('#upload-discount-image').fileupload({
            dataType        : 'json',
            autoUpload      : true,
            acceptFileTypes : /(\.|\/)(gif|jpe?g|png)$/i,
            maxFileSize     : 5000000, // 5 MB
            previewMaxWidth : 100,
            previewMaxHeight: 100,
            previewCrop     : true
        }).on('fileuploadprogressall',function(e,data){
            
                $('#fileupload-progress').show();
                var progress    = parseInt(data.loaded / data.total * 100, 10);
                $('#fileupload-progress .progress-bar').css('width',progress + '%');
                
                if(progress == 100){
                    $('#fileupload-progress').hide();
                    $('#fileupload-progress .progress-bar').css('width','0%');  
                }
        }).on('fileuploaddone',function(e,data){

            $.each(data.result.files, function (index, file) {
                if(file.url){
                    $('#discount-image-new').val(file.name);
                    $('#discount-image-preview').attr('src',file.thumbnailUrl);
                }
            });

        });

    $('#upload-profile-image').fileupload({
            dataType        : 'json',
            autoUpload      : true,
            acceptFileTypes : /(\.|\/)(gif|jpe?g|png)$/i,
            maxFileSize     : 5000000, // 5 MB
            previewMaxWidth : 100,
            previewMaxHeight: 100,
            previewCrop     : true
        }).on('fileuploadprogressall',function(e,data){
            
                $('#fileupload-progress').show();
                var progress    = parseInt(data.loaded / data.total * 100, 10);
                $('#fileupload-progress .progress-bar').css('width',progress + '%');
                
                if(progress == 100){
                    $('#fileupload-progress').hide();
                    $('#fileupload-progress .progress-bar').css('width','0%');  
                }
        }).on('fileuploaddone',function(e,data){

            $.each(data.result.files, function (index, file) {
                if(file.url){
                    $('#profile_image').val(file.name);
                    $('#profile-image-preview').attr('src',file.thumbnailUrl)
                    $('#delete-profile-image').attr('delete-url',file.deleteUrl);
                    $('#delete-profile-image').show();
                    $('#upload-profile-image').parent().find('span').text('Replace Image');
                }
            });

        });

    }  
    this.init_fileupload_actions = function(){

        $('.btn-delete-fileupload').click(function(){
            var current_item    = $(this);
            var image_name      = $(this).parent().parent().find('.image-name').val()
            var primary_image   = $('#item_primary_image').val();
            $.ajax({
                url     : current_item.attr('delete-url'),
                type    : 'DELETE',
                success : function(data){
                    current_item.parent().parent().remove();
                    if(image_name == primary_image){
                        $('#item_primary_image').val($('.image-name').eq(0).val());
                        $('.image-name').eq(0).parent().parent().find('.btn-set-as-primary').hide();
                    }

                }
            });
        });

        $('#fileupload-delete-all').click(function(){

            var fileupload_items = $('.fileupload-item');
            $.each(fileupload_items,function(index,item){

                var delete_url      = $(item).find('.btn-delete-fileupload').attr('delete-url');
                var image_name      = $(item).find('.image-name').val();

                $.ajax({
                    url     : delete_url,
                    type    : 'DELETE',
                    success : function(data){
                        item.remove();
                    }
                });
            });

        });

        $('.btn-set-as-primary').click(function(){
            var current_upload  = $(this).parent().parent();
            $('#item_primary_image').val(current_upload.find('.image-name').val());
            $('.btn-set-as-primary').show();
            $(this).hide();
        });

        $('#btn-remove-discount-image').click(function(){
            $('#discount_image').val('');
        });

        $('#delete-profile-image').click(function(){

            $.ajax({
                url     : $(this).attr('delete-url'),
                type    : 'DELETE',
                success : function(data){
                    $('#profile_image').val('');
                    $('#profile-image-preview').attr('src','');
                    $('#delete-profile-image').attr('delete-url','');
                    $('#delete-profile-image').hide();
                    $('#upload-profile-image').parent().find('span').text('Upload Image');


                            var user_id = $('#user_id').val();
                            $.ajax({
                                type    : 'put',
                                url     : '/profile_image',
                                data    : {
                                            user_id         : $('#user_id').val(),
                                            profile_image   : $('#profile_image').val()
                                },
                                dataType: 'json',
                                success : function(result){
                                }
                            });
                           
                }
            });
        });
    }

    this.delete_image = function(object,image){
        $.ajax({
            url     : '/upload/'+object+'/?file='+image,
            type    : 'DELETE',
            success : function(data){
                return true;
            }
        });
    }
}

window.bc_fileupload = new bc_fileupload();
window.bc_fileupload.init_fileupload();

