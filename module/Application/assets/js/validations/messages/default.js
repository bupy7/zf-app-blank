(function() {
    'use strict';

    _.extend(Backbone.Validation.messages, {
        required: i18next.t('ERROR_REQUIRED'),
        acceptance: '{0} must be accepted',
        min: '{0} must be greater than or equal to {1}',
        max: '{0} must be less than or equal to {1}',
        range: '{0} must be between {1} and {2}',
        length: '{0} must be {1} characters',
        minLength: i18next.t('ERROR_MIN_LENGTH'),
        maxLength: i18next.t('ERROR_MAX_LENGTH'),
        rangeLength: i18next.t('ERROR_RANGE_LENGTH'),
        oneOf: '{0} must be one of: {1}',
        equalTo: '{0} must be the same as {1}',
        digits: '{0} must only contain digits',
        number: '{0} must be a number',
        url: '{0} must be a valid url',
        inlinePattern: '{0} is invalid',
        pattern: i18next.t('ERROR_PATTERN')
    });
})();
