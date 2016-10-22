$.fn.serializeObject = function() {
    'use strict';
    
    var a = {};
    function b(item, index) {
        var d = a[item.name];
        typeof d != 'undefined' && d !== null
            ? Array.isArray(d)
                ? d.push(item.value)
                : a[item.name] = [d, item.value]
            : a[item.name] = item.value;
    };
    return this.serializeArray().forEach(b), a;
};
