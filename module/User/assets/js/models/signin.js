var App = App || {};

(function () {
    'use strict';

    App.SignIn = Backbone.Model.extend({
        validation: {
            email: {
                required: true,
                format: 'email'
            },
            password: {
                required: true
            }
        }
    });
})();
