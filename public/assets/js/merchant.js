//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse')
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse')
        }

        height = (this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    })
})


var bc_merchant = function(){

    var self = this;

    this.init_merchant = function(){
        
        self.init_modals();

        $('#side-menu').metisMenu();

        /*Merchant Registration*/
        $('#form-create-merchant').submit(function(e){
            $.ajax({
                type    : 'post',
                url     : '/merchant/create',
                data    : $(this).serialize(),
                dataType: 'json',
                success : function(result){
                    $('div.form-group.has-error label').hide();
                    $('div.form-group.has-error').removeClass('has-error');

                    if(result.success){
                        self.clear_form_create_merchant();
                        $('#create-merchant-success').show();
                    }else{
                        $('#create-merchant-success').hide();
                        if(result.error_message.merchant_name)   { self.show_form_group_error('merchant_name',result.error_message.merchant_name); }
                        if(result.error_message.username)        { self.show_form_group_error('username',result.error_message.username); }
                        if(result.error_message.password)        { self.show_form_group_error('password',result.error_message.password); }
                        if(result.error_message.password_confirmation) { self.show_form_group_error('password_confirmation',result.error_message.password_confirmation); }
                        if(result.error_message.email)   { self.show_form_group_error('email',result.error_message.email_address); }
                    }
                    $("html, body").animate({scrollTop: 0}, 100);
                }
            });
            e.preventDefault();
        });


        /*Merchant Login*/
        $('#form-merchant-login').submit(function(e){
            $.ajax({
                type    : 'post',
                url     : '/login',
                data    : $(this).serialize(),
                dataType: 'json',
                success : function(result){
                    if(result.success){
                        $('#merchant-login-alert').removeClass('alert-danger');
                        $('#merchant-login-alert').addClass('alert-success');
                        $('#merchant-login-alert p').html('<strong>Success!</strong> Redirecting..');
                        $('#merchant-login-alert').show();
                        window.location = '/';
                    }else{                        
                        $('#merchant-login-alert p').html(result.error_message);
                        $('#merchant-login-alert').addClass('alert-danger');
                        $('#merchant-login-alert').show();
                    }
                }
            });
            e.preventDefault();
        });

        /*Merchant Create Item*/
        $('#form-create-item').submit(function(e){
            $.ajax({
                type    : 'post',
                url     : '/item',
                data    : $(this).serialize(),
                dataType: 'json',
                success : function(result){
                    $('div.form-group.has-error label').hide();
                    $('div.form-group.has-error').removeClass('has-error');

                    if(result.success){
                        self.clear_form_create_item();
                        $('#create-item-success').show();
                    }else{
                        $('#create-item-success').hide();
                        if(result.error_message.name)               { self.show_form_group_error('item_name',result.error_message.name); }
                        if(result.error_message.price)              { $('#item_price').parent().parent().addClass('has-error');$('#item_price').parent().parent().find('label').text(result.error_message.price);$('#item_price').parent().parent().find('label').show(); }
                        if(result.error_message.description)        { self.show_form_group_error('item_description',result.error_message.description); }
                        if(result.error_message.brand_id)           { self.show_form_group_error('item_brand',result.error_message.brand_id); }
                        if(result.error_message.item_main_category) { self.show_form_group_error('item_main_category',result.error_message.item_main_category); }
                        if(result.error_message.item_sub_category)  { self.show_form_group_error('item_sub_category',result.error_message.item_sub_category); }
                        if(result.error_message.item_primary_image) { $('#item-image-error').show();} else { $('#item-image-error').hide(); }
                    }
                    $("html, body").animate({scrollTop: 0}, 100);
                }
            });
            e.preventDefault();
        });

        /*Merchant Update Item*/
        $('#form-update-item').submit(function(e){
            var item_id = $('#item_id').val();
            $.ajax({
                type    : 'put',
                url     : '/item/'+item_id,
                data    : $(this).serialize(),
                dataType: 'json',
                success : function(result){
                    $('div.form-group.has-error label').hide();
                    $('div.form-group.has-error').removeClass('has-error');

                    if(result.success){
                        $('#update-item-success').show();
                    }else{
                        $('#update-item-success').hide();
                        if(result.error_message.name)               { self.show_form_group_error('item_name',result.error_message.name); }
                        if(result.error_message.price)              { $('#item_price').parent().parent().addClass('has-error');$('#item_price').parent().parent().find('label').text(message);$('#item_price').parent().parent().find('label').show(); }
                        if(result.error_message.description)        { self.show_form_group_error('item_description',result.error_message.description); }
                        if(result.error_message.brand_id)           { self.show_form_group_error('item_brand',result.error_message.brand_id); }
                        if(result.error_message.item_main_category) { self.show_form_group_error('item_main_category',result.error_message.item_main_category); }
                        if(result.error_message.item_sub_category)  { self.show_form_group_error('item_sub_category',result.error_message.item_sub_category); }
                        if(result.error_message.item_primary_image) { $('#item-image-error').show();} else { $('#item-image-error').hide(); }
                    }
                    $("html, body").animate({scrollTop: 0}, 100);
                }
            });
            e.preventDefault();
        });


        $('#item_main_category').change(function(){            
            var url = '/category/'+$(this).val()+'/subcategory';
            $.get(url, function(result) {
                  if(result.length > 0){
                    $('#item_sub_category').html('<option value="">Select Sub Category</option>');
                    $.each(result,function(i,category){
                        $('#item_sub_category').append('<option value="'+category.id+'">'+category.name+'</option>');
                    });
                  }
            });

            var url = '/category/'+$(this).val()+'/brand';
            $.get(url, function(result) {
                  if(result.brands.length > 0){
                    $('#item_brand').html('<option value="">Select Brand Name</option>');
                    $.each(result.brands,function(i,brand){
                        $('#item_brand').append('<option value="'+brand.id+'">'+brand.name+'</option>');
                    });
                  }
            });
            
        });

        $('#form-create-discount').submit(function(e){
            $.ajax({
                type    : 'post',
                url     : '/discount',
                data    : $(this).serialize(),
                dataType: 'json',
                success : function(result){
                    $('div.form-group.has-error label').hide();
                    $('div.form-group.has-error').removeClass('has-error');

                    if(result.success){
                        self.clear_form_create_discount();
                        $('#create-discount-success').show();
                    }else{
                        $('#create-discount-success').hide();
                        if(result.error_message.title)          { self.show_form_group_error('discount_title',result.error_message.title); }
                        if(result.error_message.type)           { self.show_form_group_error('discount_type',result.error_message.type); }
                        if(result.error_message.price)          { self.show_form_group_error('discount_price',result.error_message.price); }
                        if(result.error_message.rate)           { self.show_form_group_error('discount_rate',result.error_message.rate); }
                        if(result.error_message.description)    { self.show_form_group_error('discount_description',result.error_message.description); }
                        if(result.error_message.image)          { self.show_form_group_error('discount_image',result.error_message.image); }
                        if(result.error_message.date)           { $('#discount_date').parent().parent().find('label').text(result.error_message.date); $('#discount_date').parent().parent().addClass('has-error'); $('#discount_date').parent().parent().find('label').show();}
                    }
                    $("html, body").animate({scrollTop: 0}, 100);
                }
            });
            e.preventDefault();
        });

        $('#form-update-discount').submit(function(e){
            var discount_id = $('#discount_id').val();
            $.ajax({
                type    : 'put',
                url     : '/discount/'+discount_id,
                data    : $(this).serialize(),
                dataType: 'json',
                success : function(result){
                    $('div.form-group.has-error label').hide();
                    $('div.form-group.has-error').removeClass('has-error');

                    if(result.success){
                        $('#update-discount-success').show();
                        if(result.data.old_image && result.data.old_image != ''){ window.bc_fileupload.delete_image('discount',result.data.old_image); }
                    }else{
                        $('#update-discount-success').hide();
                        if(result.error_message.title)          { self.show_form_group_error('discount_title',result.error_message.title); }
                        if(result.error_message.type)           { self.show_form_group_error('discount_type',result.error_message.type); }
                        if(result.error_message.price)          { self.show_form_group_error('discount_price',result.error_message.price); }
                        if(result.error_message.rate)           { self.show_form_group_error('discount_rate',result.error_message.rate); }
                        if(result.error_message.description)    { self.show_form_group_error('discount_description',result.error_message.description); }
                        if(result.error_message.image)          { self.show_form_group_error('discount_image',result.error_message.image); }
                        if(result.error_message.date)           { $('#discount_date').parent().parent().find('label').text(result.error_message.date); $('#discount_date').parent().parent().addClass('has-error'); $('#discount_date').parent().parent().find('label').show();}
                    }
                    $("html, body").animate({scrollTop: 0}, 100);
                }
            });
            e.preventDefault();
        });

        $('#form-update-merchant').submit(function(e){
            var merchant_id = $('#merchant_id').val();
            $.ajax({
                type    : 'post',
                url     : '/merchant/update/'+merchant_id,
                data    : $(this).serialize(),
                dataType: 'json',
                success : function(result){
                    $('div.form-group.has-error label').hide();
                    $('div.form-group.has-error').removeClass('has-error');

                    if(result.success){
                        $('#update-user-success').show();
                        //if(result.data.old_image && result.data.old_image != ''){ window.bc_fileupload.delete_image('discount',result.data.old_image); }
                    }else{
                        $('#update-user-success').hide();
                        if(result.error_message.name)                   { self.show_form_group_error('name',result.error_message.name); }
                        if(result.error_message.username)               { self.show_form_group_error('username',result.error_message.username); }
                        if(result.error_message.password)               { self.show_form_group_error('password',result.error_message.password); }
                        if(result.error_message.password_confirmation)  { self.show_form_group_error('password_confirmation',result.error_message.password_confirmation); }
                        if(result.error_message.email)                  { self.show_form_group_error('email',result.error_message.email); }
                    }
                    $("html, body").animate({scrollTop: 0}, 100);
                }
            });
            e.preventDefault();
        });
    }

    this.init_modals = function(){

        $('.btn-view-item-details').unbind().click(function(e){
            var item_id = $(this).attr('item-id');
            var url     = '/item/'+item_id;
            $.get(url, function(result) {
                $('#bc-merchant-modal .modal-title').html('Item Details');
                $('#bc-merchant-modal .modal-body').html(result);
                $('#bc-merchant-modal .modal-footer').html('<a href="/item/'+item_id+'/edit"><button type="button" class="btn btn-primary">Update</button></a>&nbsp;<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
                
                if(result.length > 0){
                    $('#item_sub_category').html('<option value="">Select Sub Category</option>');
                    $.each(result,function(i,category){
                        $('#item_sub_category').append('<option value="'+category.id+'">'+category.name+'</option>');
                    });
                }
            });
            e.preventDefault();
        });

        $('.btn-view-discount-details').unbind().click(function(e){
            var discount_id = $(this).attr('discount-id');
            var url         = '/discount/'+discount_id;
            $.get(url, function(result) {
                $('#bc-merchant-modal .modal-title').html('Discount Details');
                $('#bc-merchant-modal .modal-body').html(result);
                $('#bc-merchant-modal .modal-footer').html('<a href="/discount/'+discount_id+'/edit"><button type="button" class="btn btn-primary">Update</button></a>&nbsp;<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
            });
            e.preventDefault();
        });
    }

    this.init_datatables = function(){            
            $('#merchant-item-list').dataTable({
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 0,6 ] }
                ]
            });

            $('#merchant-discount-list').dataTable({
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [0,4] }
                ]
            });

            $('#merchant-discount-item-list').dataTable({
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [0,7] }
                ]
            });

            $('#merchant-listing').dataTable();
    }

    this.init_datepicker = function(){
        $('#discount_date').daterangepicker(
            {
                /*options*/
            },
            function(start, end, label) {
                $('#discount_start').val(start.format('YYYY-MM-DD'));
                $('#discount_end').val(end.format('YYYY-MM-DD'));
            }
        );
    }

    this.show_form_group_error = function(field,message){
        $('#'+field).parent().addClass('has-error');
        $('#'+field).parent().find('label').text(message);
        $('#'+field).parent().find('label').show();
    }
    this.clear_form_create_merchant = function(){
        $('#merchant_name').val('');
        $('#username').val('');
        $('#password').val('');
        $('#password_confirmation').val('');
        $('#email').val('');
    }
    this.clear_form_create_item = function(){
        $('#item_name').val('');
        $('#item_price').val('');
        $('#item_main_category').val('');
        $('#item_sub_category').html('<option value="">Select Sub Category</option>');
        $('#item_brand').html('<option value="">Select Brand Name</option>');
        $('#item_description').val('');
        $('#item_primary_image').val('');
        $('table#uploaded_images').html('');
        $('#fileupload-delete-all').hide();
    }
    this.clear_form_create_discount = function(){
        $('#discount_name').val('');
        $('#discount_type').val('');
        $('#discount_price').val('');
        $('#discount_rate').val('');
        $('#discount_date').val('');
        $('#discount_description').val('');
        $('#discount_image').val('');
        $('table#uploaded_images').html('');

        $('.discount-type-input').hide();
    }
}

window.bc_merchant = new bc_merchant();
window.bc_merchant.init_merchant();

