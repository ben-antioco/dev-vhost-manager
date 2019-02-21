let moddelete = {

    Init: ()=> {

        /**
         * DELETE ITEM
         */
        $d.off('click', '.param_delete').on('click', '.param_delete', function(){

            var itemId = $(this).parent().attr('data-id');

            $('.modal_confirm').fadeIn( 300 );

            $d.off('click', '.confirm_btn').on('click', '.confirm_btn', function(){

                moddelete.AjaxDeleteItem( itemId );

                $('.modal_confirm').hide();
            });

            $d.off('click', '.cancel_btn').on('click', '.cancel_btn', function(){

                $('.modal_confirm').fadeOut( 300 );
            });
        });

    },

    AjaxDeleteItem: ( itemId )=> {

        $.ajax({
            type: 'POST',
            data: { 
                delete_item: true, 
                id: itemId
            }
        }).done( function( result ){
    
            if( result === "success"){
    
                $('.ajax_result_html').remove();
    
                $('body').append('<pre class="ajax_result_html pre_top">Suppression réussie !</pre>');
    
                setTimeout( function(){ window.location.reload(); }, 2000);
            }
            else{
                $('.ajax_result_html').remove();
    
                $('body').append('<pre class="ajax_result_html pre_top">Suppression echouée !</pre>');
            }
        });
    }
}
module.exports = moddelete;