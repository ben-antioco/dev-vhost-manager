let modappupdate = {

    Init: ()=> {
        modappupdate.AjaxGetUpdate();
    },

    AjaxGetUpdate: ()=> {

        $.ajax({
            type: 'POST',
            data: { 
                get_update: true
            }
        }).done( function( result ){
    
            console.log( result );
        });
    }
}
module.exports = modappupdate;