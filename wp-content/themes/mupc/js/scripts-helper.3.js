var helper = (function (me) {
  "use strict"

  var me = {};

  me.takeIntFromString = function(str) {
    return parseInt(str.replace ( /[^\d.]/g, '' ));
  };

  me.getParameterByName = function(name, url) {
    // https://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript
    if (!url) url = window.location.href;
    
    // fix: in case 'x=1&y=2', 'x' will be NULL, cause without any ? & prefix
    if(url.substr(0, 4) !== 'http' && url[0] !== '&' && url[0] !== '?') {
      url = '?'+url;
    }

    name = name.replace(/[\[\]]/g, '\\$&');
    
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
    results = regex.exec(url);
        
    if (!results) return null;
    if (!results[2]) return '';

    return decodeURIComponent(results[2].replace(/\+/g, ' '));
  }

  me.updateQueryStringParameter = function (uri, key, value) {
    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";

    if (uri.match(re)) {
      return uri.replace(re, '$1' + key + "=" + value + '$2');
    }

    return uri + separator + key + "=" + value;
  }

  return me;

})();