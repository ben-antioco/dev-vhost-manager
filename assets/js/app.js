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

			$('.keyword_data').addClass('keyword_data_hidden');
            var keyword = $('.keyword_data:icontains("'+searchvalue+'")').removeClass('keyword_data_hidden');
            
            $('.param_move').hide();
		}
		else{
            $('.keyword_data').removeClass('keyword_data_hidden');
            
            $('.param_move').show();
		}
	});
}

function ajaxGetUpdate(){

    $.ajax({
        type: 'POST',
        data: { 
            get_update: true
        }
    }).done( function( result ){

        console.log( result );
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

        setTimeout( function(){ $('.ajax_result_html').remove(); }, 1000);
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



function ajaxEditItem( itemId ){

    $.ajax({
        type: 'POST',
        data: { 
            edit_item_get: true, 
            id: itemId
        }
    }).done( function( result ){

        if( result ){

            let data = JSON.parse( result );

            console.log( data )

            if( result.length > 3 ){

                $('#modal_acces_items').html('');

                $( '#modal_edit_logo_img' ).attr( 'src', './uploads/'+data.vhost_data.vhost_logo );

                $( '#modal_edit_vhost_name' ).val( data.vhost_data.vhost_name );

                $( '#modal_edit_vhost_local_domain' ).val( data.vhost_data.vhost_local_domain );

                $( '#modal_edit_vhost_description' ).val( data.vhost_data.vhost_description );

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

                        accessLoop();
                    });
                }
            }
        }
    });
}

function accessLoop() {

    $('.modal_acces_item').each( function( index, item ){

        $( item ).attr( 'data-id', index );
        $( item ).find('input[type="text"]').attr( 'data-id', index );
    });
}



$d.ready(function(){

    ajaxGetUpdate();

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

    /**
     * DELETE ITEM
     */
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

    /**
     * EDIT ITEM
     */
    $d.off('click', '.param_edit').on('click', '.param_edit', function(){

        var itemId = $(this).parent().attr('data-id');

        $('.modal_edit').fadeIn( 300 );

        ajaxEditItem( itemId );
    });


    $d.off('click', '.modal_close').on('click', '.modal_close', function(){

        $('.modal').fadeOut( 300 );
    });


    $d.off('click', '.nav_open').on('click', '.nav_open', function(){

        $('#nav_container').fadeIn( 300 );

        //$('.data_container').css('margin-left', '300px');

        $('.data_container').addClass('data_container_move');
    });


    $d.off('click', '.nav_close').on('click', '.nav_close', function(){
        $('#nav_container').fadeOut( 300 );

        //$('.data_container').css('margin-left', '20px');
        $('.data_container').removeClass('data_container_move');
    });

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

        accessLoop();
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


    $d.off('change', '#vhost_logo').on('change', '#vhost_logo', function( e ){

        let $this = $(this)[0];

        if( $this.files &&  $this.files[0] ){

            var reader = new FileReader();

            reader.onload = function (e) {

                $('#blah').attr('src', e.target.result);

                $('.label_file[for="vhost_logo"]').html('<img class="nav_label_logo_img" src="' + e.target.result + '">');
            };
    
            reader.readAsDataURL( $this.files[0] );
        }
    });
});


