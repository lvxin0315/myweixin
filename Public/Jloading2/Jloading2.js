(function(window,undefined){
    var document = window.document;
    var jloading = (function(){
        var jloading = function(type){
            if( document.all ){ return false;}
            return new jloading.fn.init(type);
        };
        jloading.fn = jloading.prototype = {
            constructor : jloading,
            init : function(type){
                jloading.fn.create(type);
            },
            create : function(type){
                if( type ){
                    if( !!document.getElementById('jloading-box') ){
                        document.getElementById('jloading-box').style.display = "block";
                        document.getElementById('jloading-box-filter').style.display = "block";
                    }else{
                        var dom = document.createElement('div');
                        dom.id = "jloading-box";
                        dom.className = "jloading-box";
                        document.body.appendChild(dom);

                        var filter = document.createElement('div');
                        filter.id = "jloading-box-filter";
                        document.body.appendChild(filter);
                    }
                }else{
                    if( !!document.getElementById('jloading-box') ){
                        document.getElementById('jloading-box').style.display = "none";
                        document.getElementById('jloading-box-filter').style.display = "none";
                    }else{
                        document.body.removeChild(document.getElementById("jloading-box"));
                        document.body.removeChild(document.getElementById("jloading-box-filter"));
                    }
                }
            }
        };
        jloading.fn.init.prototype = jloading.fn;
        return jloading;
    })();
    window.Jloading = jloading;
})(window);