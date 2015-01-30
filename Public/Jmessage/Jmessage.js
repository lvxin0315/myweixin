/* @消息框组件 BY jinye */
//Jmessage({ type: 'success',info:"操作成功"});
(function(window,undefined){
    var document = window.document;
    var jmessage = (function(){
        var jmessage = function(params){
            return new jmessage.fn.init(params);
        };
        var time;
        jmessage.fn = jmessage.prototype = {
            constructor : jmessage,
            init : function(params){
                var p = params || "";
                if( p == "" ){ return false; }
                if( (typeof p.link).toLowerCase() == "string" ){
                    jmessage.fn.link( p.link );
                }
                var info = p.info;
                jmessage.fn.create( p.type,info );
            },
            link : function(url){
                try{
                    var stylecss = document.createElement('link');
                    stylecss.rel = "stylesheet";
                    stylecss.type = "text/css";
                    stylecss.href = url;
                    document.getElementsByTagName('head')[0].appendChild(stylecss);
                }catch (error){
                    return false;
                }
            },
            create : function(type,info){
                clearTimeout(time);
                if( !!document.getElementById('jmessage-box') ){
                    document.getElementById('jmessage-box').style.display = "block";
                    document.getElementById('jmessage-box-mains').className = 'jmessage-box-main   '+type+'';
                    document.getElementById('jmessage-box-mains').innerHTML = info;
                }else{
                    var dom = document.createElement('div');
                    dom.id = "jmessage-box";
                    dom.className = "jmessage-box";
                    var dom2 = document.createElement('div');
                    dom2.id = "jmessage-box-mains";
                    dom2.className = 'jmessage-box-main   '+type+'';
                    dom2.innerHTML = info;
                    document.body.appendChild(dom);
                    dom.appendChild(dom2);
                }

                time = setTimeout(function(){
                    document.getElementById('jmessage-box').style.display = "none";
                },2000);
            }
        };
        jmessage.fn.init.prototype = jmessage.fn;

        return jmessage;
    })();
    window.Jmessage = jmessage;
})(window);