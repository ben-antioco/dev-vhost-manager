let modmove = {

    Init : ()=> {

        /**
         * SORTABLE ITEMS
         */
        $(".data_items, .list_items_container").sortable({
            handle: ".param_move",
            tolerance: "pointer",
            update: function( event, ui ) {

                modmove.IndexItem();// INDEXES ITEMS
            }
        });

    },

    /**
     * INDEXES ALL ITEMS 
     */
    IndexItem: ()=> {

        $('.data_item, .list_item').each(function( index, item){

            let itemId = $(item).attr('data-id');

            $(item).attr('data-index', index);

            $(item).find('.item_vhost_position').text( index );

            modmove.AjaxUpdatePosition( itemId, index );
        });
    },

    /**
     * UPDATE POSITION ITEM
     * @param {*} itemId 
     * @param {*} index 
     */
    AjaxUpdatePosition: ( itemId, index )=> {

        $.ajax({
            type: 'POST',
            data: { 
                update_position: true, 
                id: itemId, 
                position: index 
            }
        }).done( function( result ){

            $('.ajax_result_html').remove();

            $('body').append('<pre class="ajax_result_html pre_top">'+result+'</pre>');

            setTimeout( function(){ $('.ajax_result_html').remove(); }, 1000);
        });
    }

}
module.exports = modmove;