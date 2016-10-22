(function() {
    'use strict';

    _.extend(Backbone.Validation.callbacks, {
        valid: function (view, attr, selector) {
            var $el = view.$('[name=' + attr + ']'),
                $group = $el.closest('.form-group');

            $group.removeClass('has-error').addClass('has-success');
            $group.find('.help-block-error').html('');
        }
    });
})();
