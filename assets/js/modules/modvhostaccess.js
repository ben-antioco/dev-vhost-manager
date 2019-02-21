let modvhostaccess = {

    Init: ()=> {

        $d.off('click', '.modal_vhost_access_add').on('click', '.modal_vhost_access_add', function(){

            let access_item =
            '<div class="modal_acces_item modal_edit_flex" data-id="0">'+
    
                '<div class="modal_vhost_access_delete"><i class="fas fa-times-circle"></i></div>'+
    
                '<div class="field_container">'+
                    '<label class="modal_label_field" for="">Label</label>'+
                    '<input class="input_form_add" type="text" name="vhost_access_label_edit[]" placeholder="Acces label">'+
                '</div>'+
    
                '<div class="field_container">'+
                    '<label class="modal_label_field" for="">Login</label>'+
                    '<input class="input_form_add" type="text" name="vhost_access_login_edit[]" placeholder="Access login">'+
                '</div>'+
    
                '<div class="field_container">'+
                    '<label class="modal_label_field" for="">Password</label>'+
                    '<input class="input_form_add" type="text" name="vhost_access_password_edit[]" placeholder="Access password">'+
                '</div>'+
    
            '</div>';
    
            $('#modal_acces_items').append( access_item );  
    
            modvhostaccess.AccessLoop();
        });
    
    
        $d.off('click', '.modal_vhost_access_delete').on('click', '.modal_vhost_access_delete', function(){
    
            let $this =$(this);
    
            $('.modal_confirm').fadeIn( 300 );
    
            $d.off('click', '.confirm_btn').on('click', '.confirm_btn', function(){
    
                $this.parent('.modal_acces_item').remove();
    
                $('.modal_confirm').hide();
            });
    
            $d.off('click', '.cancel_btn').on('click', '.cancel_btn', function(){
    
                $('.modal_confirm').fadeOut( 300 );
            });
    
        });
    },

    AccessLoop: ()=> {

        $('.modal_acces_item').each( function( index, item ){
    
            $( item ).attr( 'data-id', index );
            $( item ).find('input[type="text"]').attr( 'data-id', index );
        });
    }
}
module.exports = modvhostaccess;