$(function() {

    $('#side-menu').metisMenu();

});

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

    }

}

var sgcardeals_admin = new bc_merchant();
sgcardeals_admin.init_merchant();