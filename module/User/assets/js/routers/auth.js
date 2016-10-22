var App = App || {};

(function() {
    'use strict';

    App.AuthRouter = Backbone.Router.extend({
        routes: {
            'signin': 'signin'
        },
        signin: function() {
            new App.SignInView({
                el: 'form',
                model: new App.SignIn
            });
        }
    });
})();
