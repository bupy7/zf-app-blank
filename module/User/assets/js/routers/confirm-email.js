var App = App || {};

(function () {
    'use strict';

    App.ConfirmEmailRouter = Backbone.Router.extend({
        routes: {
            'confirm-again': 'confirmAgain'
        },
        confirmAgain: function () {
            new App.ConfirmAgainView({
                el: 'form',
                model: new App.ConfirmAgain
            });
        }
    });
})();
