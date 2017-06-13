var App = App || {};

(function () {
    'use strict';

    App.AccessRouter = Backbone.Router.extend({
        routes: {
            'forgot-pass': 'forgotPass',
            'restore-pass/:e/:p': 'restorePass'
        },
        forgotPass: function () {
            new App.ForgotPassView({
                el: 'form',
                model: new App.ForgotPass
            });
        },
        restorePass: function () {
            new App.RestorePassView({
                el: 'form',
                model: new App.RestorePass
            });
        }
    });
})();
