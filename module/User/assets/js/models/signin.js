var App = App || {};

(function() {
    'use strict';

    App.SignIn = Backbone.Model.extend({
        validation: {
            email: {
                required: true,
                pattern: 'email'
            },
            password: {
                required: true
            }
        }
    });
})();
