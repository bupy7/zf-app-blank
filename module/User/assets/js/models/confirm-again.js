var App = App || {};

(function () {
    'use strict';

    App.ConfirmAgain = Backbone.Model.extend({
        validation: {
            email: {
                required: true,
                format: 'email'
            }
        }
    });
})();
