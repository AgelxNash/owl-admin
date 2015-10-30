function renderTPL(template, data) {
    var out = '';
    if (template != '') {
        out = template.replace(/[\r\t\n]/g, " ")
            .split("<%").join("\t")
            .replace(/((^|%>)[^\t]*)'/g, "$1\r")
            .replace(/\t=(.*?)%>/g, "',$1,'")
            .split("\t").join("');")
            .split("%>").join("p.push('")
            .split("\r").join("\\'");
        out = new Function("obj", "var p=[],print=function(){p.push.apply(p,arguments);};with(obj){p.push('" + out + "');}return p.join('');")(data);
    }
    return out;
}