let modvhostedit = {

    Init: ()=> {

        /**
         * EDIT ITEM
         */
        $d.off('click', '.param_edit').on('click', '.param_edit', function(){

            var itemId = $(this).parent().attr('data-id');

            $('.modal_edit').fadeIn( 300 );

            modvhostedit.AjaxEditItem( itemId );
        });
    },

    AjaxEditItem: ( itemId )=> {

        let modvhostaccess  = require('./modvhostaccess.js');

        $.ajax({
            type: 'POST',
            data: { 
                edit_item_get: true, 
                id: itemId
            }
        }).done( function( result ){
    
            if( result ){
    
                let data = JSON.parse( result );
    
                if( result.length > 3 ){
    
                    $('#modal_acces_items').html('');
    
                    $( '#modal_edit_logo_img' ).attr( 'src', './uploads/'+data.vhost_data.vhost_logo );
    
                    $( '#modal_edit_vhost_name' ).val( data.vhost_data.vhost_name );
    
                    $( '#modal_edit_vhost_local_domain' ).val( data.vhost_data.vhost_local_domain );
    
                    $( '#modal_edit_vhost_description' ).val( data.vhost_data.vhost_description );

                    if( data.vhost_data.vhost_description ) editor.value = data.vhost_data.vhost_description;
                    else editor.value = '';

                    $( '#modal_edit_env' ).children( 'option[value="'+data.vhost_data.env+'"]' ).prop( 'selected', true );
    
                    $( '#modal_edit_vhost_id' ).val( data.vhost_data.id );
    
                    if( data.vhost_access.length >= 1 ){
    
                        $.each( data.vhost_access, function( index, item ){
    
                            let access_item =
                            '<div class="modal_acces_item modal_edit_flex" data-id="'+index+'">'+
    
                                '<div class="modal_vhost_access_delete"><i class="fas fa-times-circle"></i></div>'+
    
                                '<div class="field_container">'+
                                    '<label class="modal_label_field" for="">Label</label>'+
                                    '<input class="input_form_add" type="text" name="vhost_access_label_edit[]" placeholder="Acces label" value="'+item.access_label+'">'+
                                '</div>'+
    
                                '<div class="field_container">'+
                                    '<label class="modal_label_field" for="">Login</label>'+
                                    '<input class="input_form_add" type="text" name="vhost_access_login_edit[]" placeholder="Access login" value="'+item.access_login+'">'+
                                '</div>'+
    
                                '<div class="field_container">'+
                                    '<label class="modal_label_field" for="">Password</label>'+
                                    '<input class="input_form_add" type="text" name="vhost_access_password_edit[]" placeholder="Access password" value="'+item.access_password+'">'+
                                '</div>'+
    
                            '</div>';
    
                            $('#modal_acces_items').append( access_item );  
    
                            modvhostaccess.AccessLoop();
                        });
                    }
                }
            }
        });
    }
}
module.exports = modvhostedit;