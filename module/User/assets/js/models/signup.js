var App = App || {};

(function() {
    'use strict';

    App.SignUp = Backbone.Model.extend({
        validation: {
            person: {
                required: true
            },
            email: [
                {
                    required: true,
                    pattern: 'email'
                },
                {
                    noExists: {
                        url: '/signup/email-valid'
                    }
                }
            ],
            password: [
                {
                    required: true
                },
                {
                    rangeLength: [4, 25]
                }
            ]
        }
    });
})();
