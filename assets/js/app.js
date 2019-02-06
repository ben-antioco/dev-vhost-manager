import "../scss/app.scss";

"use-strict";

var $d = $(document);

//indexItem();

Icontains( 'input[name="research"]', 2 );


/*
	@inputText : input de recherche
	@valueLength: lance la recherche à partir de x caractères..
*/
function Icontains( inputText, valueLength=2 ) {
     
	$.expr[':'].icontains = function(a, i, m) {
		var rExps=[
			{re: /[\xC0-\xC6]/g, ch: "A"},
			{re: /[\xE0-\xE6]/g, ch: "a"},
			{re: /[\xC8-\xCB]/g, ch: "E"},
			{re: /[\xE8-\xEB]/g, ch: "e"},
			{re: /[\xCC-\xCF]/g, ch: "I"},
			{re: /[\xEC-\xEF]/g, ch: "i"},
			{re: /[\xD2-\xD6]/g, ch: "O"},
			{re: /[\xF2-\xF6]/g, ch: "o"},
			{re: /[\xD9-\xDC]/g, ch: "U"},
			{re: /[\xF9-\xFC]/g, ch: "u"},
			{re: /[\xC7-\xE7]/g, ch: "c"},
			{re: /[\xD1]/g, ch: "N"},
			{re: /[\xF1]/g, ch: "n"}
		];

		var element = $(a).text();
		var search = m[3];

		$.each(rExps, function() {
			element = element.replace(this.re, this.ch);
			search = search.replace(this.re, this.ch);
		});

		return element.toUpperCase().indexOf(search.toUpperCase()) >= 0;
	};

	$d.off('keyup', inputText).on('keyup', inputText, function(){

		var searchvalue = $(this).val();

		if( searchvalue.length >= valueLength ){

			$('.table_list_paginate').hide();

			$('.keyword_data').addClass('keyword_data_hidden');
			var keyword = $('.keyword_data:icontains("'+searchvalue+'")').removeClass('keyword_data_hidden').addClass('keyword_data_visible');
		}
		else{
			$('.table_list_paginate').show();
			$('.keyword_data').removeClass('keyword_data_hidden keyword_data_visible');
		}
	});
}


/**
 * INDEXES ALL ITEMS 
 */
function indexItem(){

    $('.data_item, .list_item').each(function( index, item){

        let itemId = $(item).attr('data-id');

        $(item).attr('data-index', index);

        $(item).find('.item_vhost_position').text( index );

        ajaxUpdatePosition( itemId, index );
    });
}

/**
 * UPDATE POSITION ITEM
 * @param {*} itemId 
 * @param {*} index 
 */
function ajaxUpdatePosition( itemId, index ){

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

        setTimeout( function(){ $('.ajax_result_html').remove(); }, 2000);
    });
}


function ajaxDeleteItem( itemId ){

    $.ajax({
        type: 'POST',
        data: { 
            delete_item: true, 
            id: itemId
        }
    }).done( function( result ){

        console.log( result )

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


/**
 * SORTABLE ITEMS
 */
$(".data_items, .list_items_container").sortable({
    handle: ".param_move",
    tolerance: "pointer",
    update: function( event, ui ) {

        indexItem();// INDEXES ITEMS
    }
});


$d.off('click', '.param_delete').on('click', '.param_delete', function(){

    var itemId = $(this).parent().attr('data-id');

    $('.modal_confirm').fadeIn( 300 );

    $d.off('click', '.confirm_btn').on('click', '.confirm_btn', function(){

        ajaxDeleteItem( itemId );

        $('.modal_confirm').hide();
    });

    $d.off('click', '.cancel_btn').on('click', '.cancel_btn', function(){

        $('.modal_confirm').fadeOut( 300 );
    });
});


/*
$d.off('mouseenter', '#nav_hover').on('mouseenter', '#nav_hover', function(){

    $('#nav_container').fadeIn( 300 );
});

*/

$d.off('click', '.nav_open').on('click', '.nav_open', function(){

    $('#nav_container').fadeIn( 300 );
});



/*
$d.off('mouseenter', '.in_data_item, .list_item').on('mouseenter', '.in_data_item, .list_item', function(){

    $('#nav_container').fadeOut( 300 );
});

*/

$d.off('click', '.nav_close').on('click', '.nav_close', function(){
    $('#nav_container').fadeOut( 300 );
});