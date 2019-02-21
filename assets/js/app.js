import "../scss/app.scss";

"use-strict";

window.$d           = $(document);

$d.ready(function(){

    let modappupdate    = require('./modules/modappupdate.js').Init();

    let modsearch       = require('./modules/modsearch.js').Icontains( 'input[name="research"]', 2 );

    let modmove         = require('./modules/modmove.js').Init();

    let modnav          = require('./modules/modnav.js').Init();

    let moddelete       = require('./modules/moddelete.js').Init();

    let modvhostedit    = require('./modules/modvhostedit.js').Init();

    let modvhostaccess  = require('./modules/modvhostaccess.js').Init();

    let modmodal        = require('./modules/modmodal.js').Init();
});


