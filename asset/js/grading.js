$( document ).ready(function() {
    var relevant = [];
    $(".question").each(function(){
        relevant[$(this).attr('id')] = getRelevant($(this).attr('data-relevant'));
    });
    var options = {};
    $( "input" ).each(function() {
        var val = $( this ).val();
        var name = $( this ).attr('name').replace("[]","");;
        if(this.checked){
            options[name].push(val);
        }else{
            options[name] = [];
        }
    });
    updateView();

    $('input').on('change', function() {
        var val = $( this ).val();
        var name = $( this ).attr('name').replace("[]","");
        if(this.checked){
            if($( this ).attr('type')=="radio"){
                options[name][0] = val;
            }else{
                options[name].push(val);
            }
            
        }else{
            if($( this ).attr('type')=="radio"){
                options[name] = [];
            }else{
                var idx = $.inArray(val,options[name]);
                if (idx !== -1) options[name].splice(idx, 1);
            }
        }
        updateView();
    });

    function updateView(){
        $('.question').each(function(){
            var enabled = false;
            var id = $(this).attr('id');
            var rels = relevant[id];
            if($.isEmptyObject(rels)){
                enabled = true;
            }
            var keys = [];
            for (var key in rels) {      
                if (rels.hasOwnProperty(key)) keys.push(key);
            }
            for (var i = keys.length - 1; i >= 0; i--) {
                if($.inArray(rels[keys[i]],options[keys[i]])!=-1){
                    enabled = true;
                }else{
                    enabled = false;
                    break;
                }
            }

            if(enabled){
                $(this).show();
            }else{
                $(this).hide();
            }
            
        });
    }
});

function getRelevant(str){
    if(str===undefined){
        return [];
    }
    var ret = [];
    str = str.split("and");
    for (var i = str.length - 1; i >= 0; i--) {
        var newRel = str[i].substring(str[i].lastIndexOf("{")+1,str[i].lastIndexOf("}"));
        var value = str[i].substring(str[i].indexOf("'")+1,str[i].lastIndexOf("'"));
        var obj = {};
        ret[newRel] = value;
    }
    return ret;
}