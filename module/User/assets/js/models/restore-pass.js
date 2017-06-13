var App = App || {};

(function () {
    'use strict';

    App.RestorePass = Backbone.Model.extend({
        validation: {
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
