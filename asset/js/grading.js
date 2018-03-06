$( document ).ready(function() {
    var relevant = [];
    $(".question").each(function(){
        relevant[$(this).attr('id')] = getRelevant($(this).attr('data-relevant'));
    });
    var options = {};
    $( "input" ).each(function() {
        var val = $( this ).val();
        var name = $( this ).attr('name').replace("[]","");
        if(this.checked){
            options[name].push(val);
        }else{
            options[name] = [];
        }
    });
    var requires = [];
    $("input:checkbox").each(function(){
        var name = $( this ).attr('name');
        if($.inArray(name,requires)==-1){
            requires.push(name);
        }
    });
    updateView();

    $('input').on('change', function() {
        var val = $( this ).val();
        var name = $( this ).attr('name').replace("[]","");
        if(this.checked||this.selected){
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
        updateRequire();
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
                $(this).find("input").prop("required", true);
            }else{
                $(this).find("input").each(function(){
                    $(this).prop('required', false);
                    $(this).prop('checked', false);
                    $(this).prop('selected', false);
                    var val = $( this ).val();
                    var name = $( this ).attr('name').replace("[]","");
                    if(this.checked||this.selected){
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
                });
                $(this).hide();
            }
            
        });
    }

    function updateRequire(){
        for (var i = requires.length - 1; i >= 0; i--) {
            var $cbx_group = $("input:checkbox[name='"+requires[i]+"']");
            if($cbx_group.is(":checked")){
                $cbx_group.prop('required', false);
            }
        }
        
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