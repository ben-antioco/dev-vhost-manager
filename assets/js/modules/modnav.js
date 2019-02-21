let modnav = {

    Init: ()=> {

        modnav.Action();

        modnav.AddFile();
    },

    Action: ()=> {

        $d.off('click', '.nav_open').on('click', '.nav_open', function(){

            $('#nav_container').fadeIn( 300 );
    
            $('.data_container').addClass('data_container_move');
        });
    
    
        $d.off('click', '.nav_close').on('click', '.nav_close', function(){

            $('#nav_container').fadeOut( 300 );
    
            $('.data_container').removeClass('data_container_move');
        });
    },

    AddFile: ()=> {

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
    }
}
module.exports = modnav;