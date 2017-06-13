var App = App || {};

(function () {
    'use strict';

    App.SignUp = Backbone.Model.extend({
        validation: {
            person: {
                required: true
            },
            email: {
                required: true,
                format: 'email'
            },
            password: [
                {
                    required: true
                },
                {
                    minLength: 4
                }
            ]
        }
    });
})();
