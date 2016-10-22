(function() {
    'use strict';

    _.extend(Backbone.Validation.callbacks, {
        invalid: function (view, attr, error, selector) {
            var $el = view.$('[name=' + attr + ']'),
                $group = $el.closest('.form-group');

            $group.addClass('has-error');
            $group.find('.help-block-error').html(error);
        }
    });
})();
