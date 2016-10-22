var App = App || {};

(function() {
    'use strict';

    App.SignupRouter = Backbone.Router.extend({
        routes: {
            'signup': 'signup'
        },
        signup: function() {
            new App.SignUpView({
                el: 'form',
                model: new App.SignUp
            });
        }
    });
})();
