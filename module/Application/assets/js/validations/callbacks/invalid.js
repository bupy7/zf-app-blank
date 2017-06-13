(function() {
    'use strict';

    _.extend(Backbone.Validator.ViewCallbacks, {
        onInvalidField: function (name, value, errors, model) {
            var el = this.el.querySelector('[name=' + name + ']'),
                group = el.closest('.form-group');
            group.classList.add('has-error');
            group.querySelector('.help-block-error').innerHTML = errors.join("\n");
        }
    });
})();
