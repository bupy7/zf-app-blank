(function ($) {
    'use strict';

    $.fn.serializeForm = function () {
        var a = {};
        serialize(this[0]).forEach(function (item, index) {
            var d = a[item.name];
            typeof d !== 'undefined' && d !== null
                ? Array.isArray(d)
                ? d.push(item.value)
                : a[item.name] = [d, item.value]
                : a[item.name] = item.value;
        });
        return a;
    };

    function serialize(form) {
        var field, l, s = [];
        if (typeof form === 'object' && form.nodeName === 'FORM') {
            var len = form.elements.length;
            for (var i = 0; i < len; i++) {
                field = form.elements[i];
                if (
                    field.name
                    && !field.disabled
                    && ['file', 'reset', 'submit', 'button'].indexOf(field.type)
                ) {
                    if (field.type == 'select-multiple') {
                        l = form.elements[i].options.length;
                        for (var j = 0; j < l; j++) {
                            if (field.options[j].selected)
                                s[s.length] = {name: field.name, value: field.options[j].value};
                        }
                    } else if ((field.type !== 'checkbox' && field.type !== 'radio') || field.checked) {
                        s[s.length] = {name: field.name, value: field.value};
                    }
                }
            }
        }
        return s;
    }
}(jBone));
