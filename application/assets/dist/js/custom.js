function replaceUrlParam(url, paramName, paramValue)
{
    if (paramValue == null) {
        paramValue = '';
    }
    var pattern = new RegExp('\\b('+paramName+'=).*?(&|#|$)');
    if (url.search(pattern) >= 0) {
        return url.replace(pattern,'$1' + paramValue + '$2');
    }
    url = url.replace(/[?#]$/,'');
    return url + (url.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue;
}
function addParamToURL(param, value) {
    if(document.location.href.indexOf(param) > -1) {
        var url = replaceUrlParam(document.location.href, param, value)
    } else {
        if (document.location.href.indexOf("?") > -1) {
            var url = document.location.href+"&"+param+"="+value;
        } else {
            var url = document.location.href+"?"+param+"="+value;
        }
    }
    document.location = url;
}
$(document).ready(function(){
    $('#count').change(function(){
        addParamToURL('count',$(this).val() )
    });
});