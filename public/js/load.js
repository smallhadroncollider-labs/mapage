requirejs.config({
    "paths": {
        // Templating
        "text": "../vendor/requirejs-text/text",
        "json": "../vendor/requirejs-plugins/src/json",
        "lodash": "../vendor/lodash/lodash",
        "log": "../vendor/loglevel/dist/loglevel", // Logging
        "reqwest": "../vendor/reqwest/reqwest",

        // Shims
        "shimPromise": "../vendor/es6-promise/promise", // JS Promise library
        "shimJSON": "../vendor/json2/json2" // JSON Shim
    },

    "urlArgs": "bust=" +  (new Date()).getTime(),

    "shim": {
        "lodash": {
            "exports": "_"
        },

        "shimPromise": {
            "exports": "Promise"
        },

        "app": {
            "deps": [
                "shimPromise",
                "shimJSON",
                "lodash"
            ]
        }
    }
});

require(["app"]);
