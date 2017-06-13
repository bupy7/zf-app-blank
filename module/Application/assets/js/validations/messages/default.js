(function () {
    'use strict';

    /**
     * @param {String} name
     * @param {*} value
     * @param {*} expectation
     * @param {Object} validatorName
     * @returns {String}
     */
    Backbone.Validator.createMessage = function (name, value, expectation, validatorName) {
        var postfix = '';
        if (validatorName === 'format') {
            postfix += '_' + expectation.toUpperCase();
        }
        return i18next.t('ERROR_VALIDATOR_' + validatorName.camelToUS().toUpperCase() + postfix);
    };

    /**
     * @param {String} message
     * @param {String} name
     * @param {*} value
     * @param {*} expectation
     * @returns {String}
     */
    Backbone.Validator.formatMessage = function (message, name, value, expectation) {
        var tpl = _.template(message);
        return tpl({
            value: value,
            exp: expectation
        });
    };
})();
