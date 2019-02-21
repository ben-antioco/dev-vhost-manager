let modmodal = {

    Init: ()=> {
        
        modmodal.Close();
    },

    Close: ()=> {

        $d.off('click', '.modal_close').on('click', '.modal_close', function(){

            $('.modal').fadeOut( 300 );
        });
    }
}
module.exports = modmodal;