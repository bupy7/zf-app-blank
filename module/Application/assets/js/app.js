var App = App || {};

(function () {
    'use strict';

    _.templateSettings = {
        interpolate: /\[\[\=(.+?)\]\]/g,
        escape: /\[\[\-(.+?)\]\]/g,
        evaluate: /\[\[(.+?)\]\]/g
    };

    _.extend(App, {
        run: function () {
            i18next.init({
                lng: document.querySelector('html').lang,
                resources: {
                    ru: App.RuLocale || {},
                    en: App.EnLocale || {}
                }
            }, function () {
                document.addEventListener('DOMContentLoaded', function () {
                    for (var name in App) {
                        if (/Router$/.test(name)) {
                            App[name.lcfirst()] = new App[name];
                        }
                    }
                    Backbone.history.start({
                        pushState: true
                    });
                });
            });
        }
    });

    App.run();
})();
