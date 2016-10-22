var App = App || {};

(function() {
    'use strict';

    App.SignUpView = Backbone.View.extend({
        events: {
            'click button[type="submit"]': function (e) {
                e.preventDefault();
                this.signUp();
            }
        },
        initialize: function () {
            Backbone.Validation.bind(this);
        },
        signUp: function () {
            var data = this.$el.serializeObject();
            this.model.set(data);
            if(this.model.isValid(true)){
                this.$el.submit();
            }
        },
        remove: function() {
            Backbone.Validation.unbind(this);
            return Backbone.View.prototype.remove.apply(this, arguments);
        }
    });
})();
