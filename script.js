/* Append a toolbar button */
if(window.toolbar != undefined){
    toolbar[toolbar.length] = {"type":  "PluginIDCount",
                               "title": LANG['plugins']['idcount']['button'],
                               "icon":  "../../plugins/idcount/button.png",
                               "key":   ""};
}


function tb_PluginIDCount(btn, props, edid) {
    PluginIDCount.edid = edid;

    PluginIDCount.getID();
}

var PluginIDCount = {
    edid: null,

    getID: function () {
        jQuery.post(
            DOKU_BASE + 'lib/exe/ajax.php',
            {
                call: 'idcount_generate'
            },
            function(data) {
                insertAtCarret(PluginIDCount.edid, data);
            },
            'text'
        );
    }
};

