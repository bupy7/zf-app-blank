var App = App || {};

(function () {
    'use strict';

    App.ForgotPass = Backbone.Model.extend({
        validation: {
            email: {
                required: true,
                format: 'email'
            }
        }
    });
})();
