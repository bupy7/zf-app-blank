(function() {
    'use strict';

    _.extend(Backbone.Validator.ViewCallbacks, {
        onValidField: function (name) {
            var el = this.el.querySelector('[name=' + name + ']'),
                group = el.closest('.form-group');
            group.classList.remove('has-error');
            group.classList.add('has-success');
            group.querySelector('.help-block-error').innerHTML = '';
        }
    });
})();
