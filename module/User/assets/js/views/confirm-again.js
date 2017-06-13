var App = App || {};

(function () {
    'use strict';

    App.ConfirmAgainView = Backbone.View.extend({
        events: {
            'change input': function (e) {
                this.validate(e.target.getAttribute('name'));
            },
            'submit': function (e) {
                e.preventDefault();
                this.submit();
            }
        },
        initialize: function () {
            this.bindValidation();
        },
        validate: function(name) {
            this.model.set(this.$el.serializeForm());
            this.model.validate(name);
        },
        submit: function () {
            this.model.set(this.$el.serializeForm());
            if (this.model.isValid()) {
                this.el.submit();
            }
        }
    });
})();
