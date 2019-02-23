let modjodit = {

    Init: ()=> {
        
        window.editor = new Jodit("#modal_edit_vhost_description", {
            autofocus: true
        });

        editor.events.on('change', function () {
            console.log( 'change' )
        })
        

        /*

        window.editor = new Jodit('#modal_edit_vhost_description', {
            defaultMode: Jodit.MODE_SPLIT
        });


        "buttons": [
                'source',
                '|',
                'bold',
                'strikethrough',
                'underline',
                'italic',
                '|',
                'superscript',
                'subscript',
                '|',
                'ul',
                'ol',
                '|',
                'outdent',
                'indent',
                '|',
                'font',
                'fontsize',
                'brush',
                'paragraph',
                '|',
                'image',
                'file',
                'video',
                'table',
                'link',
                '|',
                'align',
                'undo',
                'redo',
                '\n',
                'cut',
                'hr',
                'eraser',
                'copyformat',
                '|',
                'symbol',
                'fullsize',
                'selectall',
                'print',
                'about',
            ]

        */
        //editor.value = '<p>start</p>';
    }
}
module.exports = modjodit;