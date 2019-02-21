let modsearch = {

    /*
        @inputText : input de recherche
        @valueLength: lance la recherche à partir de x caractères..
    */
    Icontains: ( inputText, valueLength=2 )=> {

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
}
module.exports = modsearch;