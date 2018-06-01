// START Read Image File
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('.preview').attr('src', e.target.result);
            $('.remove-preview').show();
        };

        reader.readAsDataURL(input.files[0]);
    }
}
$('.remove-preview').click(function(e) {
    e.preventDefault();
    $(this).hide();
    $('.preview').attr('src', '');
    $('.feat_img').val('');
    $('.file_val').val('');
});
// END Read Image File

// START NumOnly
$('.number').keyup(function(e) {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
});
// END NumOnly

// START Admin Zipcode field restriction
function strip_zip() {
    var str = document.getElementById('zip_strip');
    var spchr = /[^0-9\s,]/gi;
    var space = /\s\s+/g;
    var comma1 = /,+/g
    var comma2 = /,,+/g;
    var commaspace = /\s,/g;
    str.value = str.value.replace(spchr, '').replace(space, '').replace(comma1, ', ').replace(comma2, ', ').replace(commaspace, ', ');
}
// END Admin Zipcode field restriction

// START Uppercase
$('.to-upper').keyup(function() {
    this.value = this.value.toUpperCase();
});
// END Uppercase

// START Admin Login
$('.admin-login').on('submit', function(e) {
    e.preventDefault();
    var login_action = $(this).attr('action');
    $.ajax({
        url: login_action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-login').html('Processing ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                $('.btn-login').html('Login');
                $('.admin-login')[0].reset();
                location.replace(msg.redirect);
            } else {
                alertify.error(msg.message);
                $('.btn-login').html('Login');
                $('.admin-login')[0].reset();
            }
        }
    });

});
// END Admin Login

$('.menu-toggle').click(function(e) {
    e.preventDefault();
    $('.page-wrap').toggleClass('toggled');
});

// START DataTables
$('.datatable').DataTable({
    responsive : true
});
// END DataTables

// START wysiwyg tinymce
tinymce.init({
    selector: 'textarea.wysiwyg',
    height: 250,
    theme: 'modern',
    plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
    ],
    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
    image_advtab: true
});

// END wysiwyg tinymce

// Admin PAGES module START
$('.addpage-form').on('submit', function(e) {
    e.preventDefault();
    var addpage_action = $(this).attr('action');
    tinyMCE.triggerSave();
    $.ajax({
        url: addpage_action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-save').html('Saving ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                $('.btn-save').html('Save');
                $('.addpage-form')[0].reset();
                location.replace(msg.redirect);
            } else {
                alertify.error(msg.message);
                $('.btn-save').html('Save');
                // $('.admin-login')[0].reset();
            }
        }
    });
});
$('.updatepage-form').on('submit', function(e) {
    e.preventDefault();
    var updatepage_action = $(this).attr('action');
    tinyMCE.triggerSave();
    $.ajax({
        url: updatepage_action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-save').html('Saving ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                $('.btn-save').html('Save');
                $('.slug').attr('data-permalink', msg.data);
            } else {
                alertify.error(msg.message);
                $('.btn-save').html('Save');
            }
        }
    });
});
// Admin PAGES module END

// Admin POSTS module START
$('.addpost-form').on('submit', function(e) {
    e.preventDefault();
    var addpost_action = $(this).attr('action');
    tinyMCE.triggerSave();
    $.ajax({
        url: addpost_action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-save').html('Saving ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                $('.btn-save').html('Save');
                location.replace(msg.redirect);
            } else {
                alertify.error(msg.message);
                $('.btn-save').html('Save');
                // $('.admin-login')[0].reset();
            }
        }
    });
});
$('.updatepost-form').on('submit', function(e) {
    e.preventDefault();
    var updatepage_action = $(this).attr('action');
    tinyMCE.triggerSave();
    $.ajax({
        url: updatepage_action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-save').html('Saving ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                $('.btn-save').html('Save');
                $('.slug').attr('data-permalink', msg.data);
            } else {
                alertify.error(msg.message);
                $('.btn-save').html('Save');
            }
        }
    });
});
// Admin POSTS module END


// Start SlugifyJS
$('.slugme, .slugup').keyup(function(){
    var Text = $(this).val().trim();
    Text = Text.toLowerCase();
    Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
    $('.slug').val(Text);
});
$('.slugcity, .slugcityup').keyup(function(){
    var city = $(this).val();
    var state = $('.slugstate, .slugstateup').val();

    var industry = $('.slugindustry, .slugindustryup');

    if(state != null) {
        var Text = city.trim() + ' ' + state.trim();
    } else {
        var Text = city.trim();
    }

    Text = Text.toLowerCase();
    Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
    //$('.slug').val(Text);

    if(industry.val() != null) {
        var prefix = industry.find(':selected').data('slug') + '/';
    } else {
        var prefix = null;
    }

    if(prefix != null) {
        $('.slug').val(prefix + Text);
    } else {
        $('.slug').val(Text);
    }
});
$('.slugindustry, .slugindustryup, .slugcountry, .slugstateup').change(function(){

    var industry = $('.slugindustry, .slugindustryup');
    var city = $('.slugcity, .slugcityup').val();
    var state = $('.slugcountry, .slugstateup').val();

    if(city != null) {
        var Text = city.trim() + ' ' + state;
    } else {
        var Text = state;
    }

    Text = Text.toLowerCase();
    Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');

    if(industry.val() != null) {
        var prefix = industry.find(':selected').data('slug') + '/';
    } else {
        var prefix = null;
    }

    if(prefix != null) {
        $('.slug').val(prefix + Text);
    } else {
        $('.slug').val(Text);
    }
});
// END SlugifyJS

// START Slug Validator
$('.slugme').keyup(function(e) {
    e.preventDefault();

    var type = $('.slug').data('posttype');
    var validator = $('.slug').data('slug');
    var slug = $('.slug').val();

    if(slug.length > 0) {
        $.ajax({
            url: validator + '?type=' + type + '&slug=' + slug,
            type: 'GET',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            error: function(data){
                if(data.readyState == 4){
                    errors = JSON.parse(data.responseText);
                }
            },
            success: function(data) {
                var msg = JSON.parse(data);
                if(msg.result == 'success'){
                    console.log(msg);
                    $('.slug').val(msg.data);
                } else {
                    console.log(msg);
                    $('.slug').val(msg.data);
                }
            }
        });
    }
});
$('.slugup').keyup(function(e) {
    e.preventDefault();
    
    var type = $('.slug').data('posttype');
    var validator = $('.slug').data('slug');
    var permalink = $('.slug').data('permalink');
    var slug = $('.slug').val();

    if(slug.length > 0 && slug != permalink) {
        $.ajax({
            url: validator + '?type=' + type + '&slug=' + slug + '&permalink=' + permalink,
            type: 'GET',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            error: function(data){
                if(data.readyState == 4){
                    errors = JSON.parse(data.responseText);
                }
            },
            success: function(data) {
                var msg = JSON.parse(data);
                if(msg.result == 'success'){
                    console.log(msg);
                    $('.slug').val(msg.data);
                } else {
                    console.log(msg);
                    $('.slug').val(msg.data);
                }
            }
        });
    }
});
$('.slugcity, .slugindustry').keyup(function(e) {
    e.preventDefault();

    var type = $('.slug').data('posttype');
    var validator = $('.slug').data('slug');
    var slug = $('.slug').val();

    if(slug.length > 0) {
        $.ajax({
            url: validator + '?type=' + type + '&slug=' + slug,
            type: 'GET',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            error: function(data){
                if(data.readyState == 4){
                    errors = JSON.parse(data.responseText);
                }
            },
            success: function(data) {
                var msg = JSON.parse(data);
                if(msg.result == 'success'){
                    console.log(msg);
                    $('.slug').val(msg.data);
                } else {
                    console.log(msg);
                    $('.slug').val(msg.data);
                }
            }
        });
    }
}).change(function(e) {
    e.preventDefault();

    var type = $('.slug').data('posttype');
    var validator = $('.slug').data('slug');
    var slug = $('.slug').val();

    if(slug.length > 0) {
        $.ajax({
            url: validator + '?type=' + type + '&slug=' + slug,
            type: 'GET',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            error: function(data){
                if(data.readyState == 4){
                    errors = JSON.parse(data.responseText);
                }
            },
            success: function(data) {
                var msg = JSON.parse(data);
                if(msg.result == 'success'){
                    console.log(msg);
                    $('.slug').val(msg.data);
                } else {
                    console.log(msg);
                    $('.slug').val(msg.data);
                }
            }
        });
    }
});
$('.slugcountry').change(function(e) {
    e.preventDefault();
    var type = $('.slug').data('posttype');
    var validator = $('.slug').data('slug');
    var slug = $('.slug').val();
    if(slug.length > 0) {
        $.ajax({
            url: validator + '?type=' + type + '&slug=' + slug,
            type: 'GET',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            error: function(data){
                if(data.readyState == 4){
                    errors = JSON.parse(data.responseText);
                }
            },
            success: function(data) {
                var msg = JSON.parse(data);
                if(msg.result == 'success'){
                    console.log(msg);
                    $('.slug').val(msg.data);
                } else {
                    console.log(msg);
                    $('.slug').val(msg.data);
                }
            }
        });
    }
});
$('.slugcityup, .slugindustryup').keyup(function(e) {
    e.preventDefault();
    
    var type = $('.slug').data('posttype');
    var validator = $('.slug').data('slug');
    var permalink = $('.slug').data('permalink');
    var slug = $('.slug').val();

    if(slug.length > 0 && slug != permalink) {
        $.ajax({
            url: validator + '?type=' + type + '&slug=' + slug + '&permalink=' + permalink,
            type: 'GET',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            error: function(data){
                if(data.readyState == 4){
                    errors = JSON.parse(data.responseText);
                }
            },
            success: function(data) {
                var msg = JSON.parse(data);
                if(msg.result == 'success'){
                    console.log(msg);
                    $('.slug').val(msg.data);
                } else {
                    console.log(msg);
                    $('.slug').val(msg.data);
                }
            }
        });
    }
}).change(function(e) {
    e.preventDefault();
    
    var type = $('.slug').data('posttype');
    var validator = $('.slug').data('slug');
    var permalink = $('.slug').data('permalink');
    var slug = $('.slug').val();

    if(slug.length > 0 && slug != permalink) {
        $.ajax({
            url: validator + '?type=' + type + '&slug=' + slug + '&permalink=' + permalink,
            type: 'GET',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            error: function(data){
                if(data.readyState == 4){
                    errors = JSON.parse(data.responseText);
                }
            },
            success: function(data) {
                var msg = JSON.parse(data);
                if(msg.result == 'success'){
                    console.log(msg);
                    $('.slug').val(msg.data);
                } else {
                    console.log(msg);
                    $('.slug').val(msg.data);
                }
            }
        });
    }
});
$('.slugstateup').keyup(function(e) {
    e.preventDefault();
    
    var type = $('.slug').data('posttype');
    var validator = $('.slug').data('slug');
    var permalink = $('.slug').data('permalink');
    var slug = $('.slug').val();

    if(slug.length > 0 && slug != permalink) {
        $.ajax({
            url: validator + '?type=' + type + '&slug=' + slug + '&permalink=' + permalink,
            type: 'GET',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            error: function(data){
                if(data.readyState == 4){
                    errors = JSON.parse(data.responseText);
                }
            },
            success: function(data) {
                var msg = JSON.parse(data);
                if(msg.result == 'success'){
                    console.log(msg);
                    $('.slug').val(msg.data);
                } else {
                    console.log(msg);
                    $('.slug').val(msg.data);
                }
            }
        });
    }
});
// END Slug Validator

// Admin TRASH PAGE POST module START
$('.btn-trash').click(function(e) {
    e.preventDefault();

    var trash = $(this);
    var entry = $(this).data('trash');
    var action = $(this).data('action');
    
    $.ajax({
        url: action,
        type: 'POST',
        data : { id : entry },
        beforeSend: function() {
            trash.html('<i class="fa fa-refresh fa-spin fa-fw txt-fff"></i>');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                console.log(msg);
                alertify.success(msg.message);
                trash.html('Trash');
                trash.parent().parent().remove();
                // location.reload();
            } else {
                console.log(msg);
                alertify.error(msg.message);
                trash.html('Trash');
            }
        }
    });
});
$('.btn-recover').click(function(e) {
    e.preventDefault();

    var selector = $(this);
    var entry = $(this).data('recover');
    var action = $(this).data('action');
    
    $.ajax({
        url: action,
        type: 'POST',
        data : { id : entry },
        beforeSend: function() {
            selector.html('<i class="fa fa-refresh fa-spin fa-fw txt-fff"></i>');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                console.log(msg);
                alertify.success(msg.message);
                selector.parent().parent().remove();
                // selector.html('Recover');
                // location.reload();
            } else {
                console.log(msg);
                alertify.error(msg.message);
                selector.html('Recover');
            }
        }
    });
});
$('.btn-delete').click(function(e) {
    e.preventDefault();
    var selector = $(this);
    var entry = $(this).data('delete');
    var action = $(this).data('action');
    $.ajax({
        url: action,
        type: 'POST',
        data : { id : entry },
        beforeSend: function() {
            selector.html('<i class="fa fa-refresh fa-spin fa-fw txt-fff"></i>');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                console.log(msg);
                alertify.success(msg.message);
                selector.html('Delete');
                selector.parent().parent().remove();
            } else {
                console.log(msg);
                alertify.error(msg.message);
                selector.html('Delete');
            }
        }
    });
});
$('.empty-trash').click(function(e) {
    e.preventDefault();
    var selector = $(this);
    var entry = $(this).data('type');
    var action = $(this).data('action');
    $.ajax({
        url: action,
        type: 'POST',
        data : { type : entry },
        beforeSend: function() {
            selector.html('Processing...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                console.log(msg);
                alertify.success(msg.message);
                selector.html('Empty Trash');
                location.reload();
            } else {
                console.log(msg);
                alertify.error(msg.message);
                selector.html('Empty Trash');
            }
        }
    });
});
// Admin TRASH PAGE POST module END

// Admin CATEGORY module START
$('.add-category').on('submit', function(e) {
    e.preventDefault();
    var action = $(this).attr('action');
    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-cat').html('Saving ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                $('.btn-cat').html('Add');
                location.reload();
            } else {
                alertify.error(msg.message);
                $('.btn-ca').html('Add');
            }
        }
    });
});
$('.update-category').on('submit', function(e) {
    e.preventDefault();

    var action = $(this).attr('action');

    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-save').html('Updating...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                $('.btn-save').html('Update');
                $('.slug').attr('data-permalink', msg.data);
                location.replace(msg.redirect);
            } else {
                alertify.error(msg.message);
                $('.btn-save').html('Update');
            }
        }
    });
});
$('.btn-delcat').click(function(e) {
    e.preventDefault();

    var selector = $(this);
    var entry = $(this).data('delete');
    var action = $(this).data('action');
    
    $.ajax({
        url: action,
        type: 'POST',
        data : { id : entry },
        beforeSend: function() {
            selector.html('<i class="fa fa-refresh fa-spin fa-fw txt-fff"></i>');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                console.log(msg);
                alertify.success(msg.message);
                selector.html('Delete');
                selector.parent().parent().remove();
                location.reload();
            } else {
                console.log(msg);
                alertify.error(msg.message);
                selector.html('Delete');
            }
        }
    });
});
// Admin CATEGORY module END

$('.clear-logs').click(function(e) {
    e.preventDefault();
    var log_panel = $('.logs');
    var log_wrap = $('.logs-wrap');

    log_wrap.html('');
    log_panel.hide();
});

// Admin CITY module START
$('.addcity-form').on('submit', function(e) {
    e.preventDefault();
    var action = $(this).attr('action');
    tinyMCE.triggerSave();
    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-save').html('Saving ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                $('.btn-save').html('Save');
                $('.addcity-form')[0].reset();
                location.replace(msg.redirect);
            } else {
                alertify.error(msg.message);
                $('.btn-save').html('Save');
            }
        }
    });
});
$('.updatecity-form').on('submit', function(e) {
    e.preventDefault();
    var action = $(this).attr('action');
    tinyMCE.triggerSave();
    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-save').html('Saving ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                $('.btn-save').html('Save');
            } else {
                alertify.error(msg.message);
                $('.btn-save').html('Save');
            }
        }
    });
});
$('.city-delete').click(function(e) {
    e.preventDefault();
    var selector = $(this);
    var entry = $(this).data('delete');
    var action = $(this).data('action');
    $.ajax({
        url: action,
        type: 'POST',
        data : { id : entry },
        beforeSend: function() {
            selector.html('<i class="fa fa-refresh fa-spin fa-fw txt-fff"></i>');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                console.log(msg);
                alertify.success(msg.message);
                selector.html('Delete');
                selector.parent().parent().remove();
                // location.reload();
            } else {
                console.log(msg);
                alertify.error(msg.message);
                selector.html('Delete');
            }
        }
    });
});
$('.delcity-all').click(function(e) {
    e.preventDefault();

    var selector = $(this);
    var entry = $(this).data('type');
    var action = $(this).data('action');
    
    $.ajax({
        url: action,
        type: 'POST',
        data : { type : entry },
        beforeSend: function() {
            selector.html('Processing...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                console.log(msg);
                alertify.success(msg.message);
                selector.html('Delete All');
                location.reload();
            } else {
                console.log(msg);
                alertify.error(msg.message);
                selector.html('Delete All');
            }
        }
    });
});
$('.cityimport-form').on('submit', function(e) {
    e.preventDefault();
    var selector = $(this);
    var action = $(this).attr('action');
    var log_panel = $('.logs');
    var log_wrap = $('.logs-wrap');

    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-import').html('Importing ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                // alertify.success(msg.message);
                $('.btn-import').html('Import');
                selector[0].reset();
                log_panel.show();
                log_wrap.html(msg.log);
            } else {
                alertify.error(msg.message);
                $('.btn-import').html('Import');
            }
        }
    });
});
// Admin CITY module END

// Admin CONFIGURATION module START
$('.config-form').on('submit', function(e) {
    e.preventDefault();
    var action = $(this).attr('action');
    
    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-config').html('Saving ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                $('.btn-config').html('Save Configuration');
                location.reload();
            } else {
                alertify.error(msg.message);
                $('.btn-config').html('Save Configuration');
            }
        }
    });
});
// Admin CONFIGURATION module END

// Admin USER module START
$('.userdetails-form').on('submit', function(e) {
    e.preventDefault();
    var action = $(this).attr('action');
    
    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-user').html('Saving ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                $('.btn-user').html('Save');
                location.reload();
            } else {
                alertify.error(msg.message);
                $('.btn-user').html('Save');
            }
        }
    });
});
$('.userpass-form').on('submit', function(e) {
    e.preventDefault();
    var action = $(this).attr('action');
    
    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-password').html('Saving ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                $('.btn-password').html('Save');
                location.replace(msg.redirect);
            } else {
                alertify.error(msg.message);
                $('.btn-password').html('Save');
            }
        }
    });
});
// Admin USER module END

// Admin COUNTRY module START
$('.addcountry-form').on('submit', function(e) {
    e.preventDefault();
    var form = $(this);
    var action = form.attr('action');
    tinyMCE.triggerSave();
    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-save').html('Saving ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                $('.btn-save').html('Save');
                form[0].reset();
                location.replace(msg.redirect);
            } else {
                alertify.error(msg.message);
                $('.btn-save').html('Save');
            }
        }
    });
});
$('.updatecountry-form').on('submit', function(e) {
    e.preventDefault();
    var action = $(this).attr('action');
    tinyMCE.triggerSave();
    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-save').html('Saving ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                $('.btn-save').html('Save');
            } else {
                alertify.error(msg.message);
                $('.btn-save').html('Save');
            }
        }
    });
});
$('.countryimport-form').on('submit', function(e) {
    e.preventDefault();
    var selector = $(this);
    var action = $(this).attr('action');
    var log_panel = $('.logs');
    var log_wrap = $('.logs-wrap');

    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-import').html('Importing ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                // alertify.success(msg.message);
                $('.btn-import').html('Import');
                selector[0].reset();
                log_panel.show();
                log_wrap.html(msg.log);
            } else {
                alertify.error(msg.message);
                $('.btn-import').html('Import');
            }
        }
    });
});
$('.country-delete').click(function(e) {
    e.preventDefault();

    var selector = $(this);
    var entry = $(this).data('delete');
    var action = $(this).data('action');
    
    $.ajax({
        url: action,
        type: 'POST',
        data : { id : entry },
        beforeSend: function() {
            selector.html('<i class="fa fa-refresh fa-spin fa-fw txt-fff"></i>');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                console.log(msg);
                alertify.success(msg.message);
                selector.html('Delete');
                selector.parent().parent().remove();
                location.reload();
            } else {
                console.log(msg);
                alertify.error(msg.message);
                selector.html('Delete');
            }
        }
    });
});
$('.delcountry-all').click(function(e) {
    e.preventDefault();

    var selector = $(this);
    var entry = $(this).data('type');
    var action = $(this).data('action');
    
    $.ajax({
        url: action,
        type: 'POST',
        data : { type : entry },
        beforeSend: function() {
            selector.html('Processing...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                console.log(msg);
                alertify.success(msg.message);
                selector.html('Delete All');
                location.reload();
            } else {
                console.log(msg);
                alertify.error(msg.message);
                selector.html('Delete All');
            }
        }
    });
});
// Admin COUNTRY module END

// Admin AIRCRAFT module START
$('.addaircraft-form').on('submit', function(e) {
    e.preventDefault();
    var form = $(this);
    var action = form.attr('action');
    tinyMCE.triggerSave();
    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-save').html('Saving ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                $('.btn-save').html('Save');
                form[0].reset();
                location.replace(msg.redirect);
            } else {
                alertify.error(msg.message);
                $('.btn-save').html('Save');
            }
        }
    });
});
$('.updateaircraft-form').on('submit', function(e) {
    e.preventDefault();
    var action = $(this).attr('action');
    tinyMCE.triggerSave();
    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-save').html('Saving ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                $('.btn-save').html('Save');
            } else {
                alertify.error(msg.message);
                $('.btn-save').html('Save');
            }
        }
    });
});
$('.aircraftimport-form').on('submit', function(e) {
    e.preventDefault();
    var selector = $(this);
    var action = $(this).attr('action');
    var log_panel = $('.logs');
    var log_wrap = $('.logs-wrap');

    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-import').html('Importing ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                // alertify.success(msg.message);
                $('.btn-import').html('Import');
                selector[0].reset();
                log_panel.show();
                log_wrap.html(msg.log);
            } else {
                alertify.error(msg.message);
                $('.btn-import').html('Import');
            }
        }
    });
});
$('.aircraft-delete').click(function(e) {
    e.preventDefault();

    var selector = $(this);
    var entry = $(this).data('delete');
    var action = $(this).data('action');
    
    $.ajax({
        url: action,
        type: 'POST',
        data : { id : entry },
        beforeSend: function() {
            selector.html('<i class="fa fa-refresh fa-spin fa-fw txt-fff"></i>');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                console.log(msg);
                alertify.success(msg.message);
                selector.html('Delete');
                selector.parent().parent().remove();
                location.reload();
            } else {
                console.log(msg);
                alertify.error(msg.message);
                selector.html('Delete');
            }
        }
    });
});
$('.delaircraft-all').click(function(e) {
    e.preventDefault();

    var selector = $(this);
    var entry = $(this).data('type');
    var action = $(this).data('action');
    
    $.ajax({
        url: action,
        type: 'POST',
        data : { type : entry },
        beforeSend: function() {
            selector.html('Processing...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                console.log(msg);
                alertify.success(msg.message);
                selector.html('Delete All');
                location.reload();
            } else {
                console.log(msg);
                alertify.error(msg.message);
                selector.html('Delete All');
            }
        }
    });
});
// Admin AIRCRAFT module END

// Admin AIRLINE module START
$('.addairline-form').on('submit', function(e) {
    e.preventDefault();
    var form = $(this);
    var action = form.attr('action');
    tinyMCE.triggerSave();
    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-save').html('Saving ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                $('.btn-save').html('Save');
                form[0].reset();
                location.replace(msg.redirect);
            } else {
                alertify.error(msg.message);
                $('.btn-save').html('Save');
            }
        }
    });
});
$('.updateairline-form').on('submit', function(e) {
    e.preventDefault();
    var action = $(this).attr('action');
    tinyMCE.triggerSave();
    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-save').html('Saving ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                $('.btn-save').html('Save');
            } else {
                alertify.error(msg.message);
                $('.btn-save').html('Save');
            }
        }
    });
});
$('.airlineimport-form').on('submit', function(e) {
    e.preventDefault();
    var selector = $(this);
    var action = $(this).attr('action');
    var log_panel = $('.logs');
    var log_wrap = $('.logs-wrap');

    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-import').html('Importing ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                // alertify.success(msg.message);
                $('.btn-import').html('Import');
                selector[0].reset();
                log_panel.show();
                log_wrap.html(msg.log);
            } else {
                alertify.error(msg.message);
                $('.btn-import').html('Import');
            }
        }
    });
});
$('.airline-delete').click(function(e) {
    e.preventDefault();

    var selector = $(this);
    var entry = $(this).data('delete');
    var action = $(this).data('action');
    
    $.ajax({
        url: action,
        type: 'POST',
        data : { id : entry },
        beforeSend: function() {
            selector.html('<i class="fa fa-refresh fa-spin fa-fw txt-fff"></i>');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                console.log(msg);
                alertify.success(msg.message);
                selector.html('Delete');
                selector.parent().parent().remove();
                // location.reload();
            } else {
                console.log(msg);
                alertify.error(msg.message);
                selector.html('Delete');
            }
        }
    });
});
$('.delairline-all').click(function(e) {
    e.preventDefault();

    var selector = $(this);
    var entry = $(this).data('type');
    var action = $(this).data('action');
    
    $.ajax({
        url: action,
        type: 'POST',
        data : { type : entry },
        beforeSend: function() {
            selector.html('Processing...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                console.log(msg);
                alertify.success(msg.message);
                selector.html('Delete All');
                location.reload();
            } else {
                console.log(msg);
                alertify.error(msg.message);
                selector.html('Delete All');
            }
        }
    });
});
// Admin AIRLINE module END