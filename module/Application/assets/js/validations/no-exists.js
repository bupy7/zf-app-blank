(function() {
    'use strict';

    /**
     * TODO: Replace to async validation. Synced request is deprecated.
     * https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/Synchronous_and_Asynchronous_Requests
     * 
     * Synced validaion at no exists value by an attribute.
     * @param {*} value
     * @param {string} attr
     * @param {Object} params:
     * - `url`: URL for value validation.
     * @returns {(string|undefined)}
     */
    function noExists(value, attr, params) {
        var data = {};
        data[attr] = value;
        var request = new XMLHttpRequest,
            url = new Url;
        request.open('get', url.join(params.url, url.encodeQuery(data)), false);
        request.send();
        if (request.status >= 200 && request.status < 400) {
            var response = JSON.parse(request.responseText);
            if (!_.isEmpty(response.errors[attr])) {
                var errors = response.errors[attr];
                return _.values(errors)[0];
            }
        }
    };

    _.extend(Backbone.Validation.validators, {
        noExists: noExists
    });
})();
